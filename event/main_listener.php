<?php
/**
 *
 * @package phpBB Extension - Unimatrix Tracking
 * @copyright (c) 2015 Gregor Kališnik
 * @copyright (c) 2015 Unimatrix
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace unimatrix\tracking\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{

  static public function getSubscribedEvents()
  {
    return array(
      'core.user_setup'                    => 'load_language_on_setup',
      'core.viewonline_overwrite_location' => 'set_external_location'
    );
  }

  /* @var \phpbb\config\config */
  protected $config;

  /* @var \phpbb\user */
  protected $user;

  /* @var \phpbb\db\driver\factory */
  protected $db;

  /* @var \phpbb\cache\service */
  protected $cache;

  /* @var core.table_prefix */
  protected $table_prefix;

  /**
   * Constructor
   *
   * @param \phpbb\user $user User object
   */
  public function __construct(\phpbb\config\config $config, \phpbb\user $user, \phpbb\db\driver\factory $db, $table_prefix)
  {
    $this->config = $config;
    $this->user = $user;
    $this->db = $db;
    $this->table_prefix = $table_prefix;
  }

  public function load_language_on_setup($event)
  {
    $lang_set_ext = $event['lang_set_ext'];
    $lang_set_ext[] = array(
      'ext_name' => 'unimatrix/tracking',
      'lang_set' => 'common',
    );

    $event['lang_set_ext'] = $lang_set_ext;
  }

  public function set_external_location($event)
  {
    if ($this->config['unimatrix_tracking_translations'])
      $this->user->add_lang('subsites');

    // We have multiple options to track
    $js_include = false;
    $on_page = $event['on_page'][0];
    if ($on_page == 'app' && substr($event['row']['session_page'], 0, 13) == 'app.php/track') {
      $on_page = 'track';
      $js_include = true;
    }

    if ($on_page == 'track') {
      /* External website */
      if ($js_include) {
        /* Using js include */
        $path = explode('path=', $event['row']['session_page'], 2);
        if (count($path) == 2)
          $path = urldecode($path[1]);
        else
          $path = '/';
      } else {
        // Using SSI include
        $path = substr($event['row']['session_page'], 9);
      }

      $name = $this->user->lang("TRACKING_VIEWING");
      if ($path) {
        // Fetch subsites
        $sql = "SELECT * FROM " . $this->table_prefix . "unimatrix_tracking_subsites";
        // TODO Put expiry time to config?
        $result = $this->db->sql_query($sql, 3600);
        while ($subsite = $this->db->sql_fetchrow($result)) {
          if(strpos($path, $subsite['subsite_path']) !== 0)
            continue;

          if (!$subsite['subsite_show'])
            $path = '/';
          $name = $this->user->lang($subsite['subsite_text']);
          // Done
          break;
        }
        $this->db->sql_freeresult($result);
      } else {
        $path = '/';
      }

      $event['location'] = $name;
      $event['location_url'] = $path;
    }
  }

}
