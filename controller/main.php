<?php
/**
*
* @package phpBB Extension - Unimatrix Tracking
* @copyright (c) 2014 Gregor Kališnik
* @copyright (c) 2014 Unimatrix
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace unimatrix\tracking\controller;

use \Symfony\Component\HttpFoundation;

class main {

  /* @var \phpbb\config\config */
  protected $config;
  /* @var \phpbb\controller\helper */
  protected $helper;
  /* @var \phpbb\template\template */
  protected $template;
  /* @var \phpbb\user */
  protected $user;

  /**
  * Constructor
  *
  * @param \phpbb\config\config $config
  * @param \phpbb\controller\helper $helper
  * @param \phpbb\template\template $template
  * @param \phpbb\user $user
  */
  public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user)
  {
    $this->config = $config;
    $this->helper = $helper;
    $this->template = $template;
    $this->user = $user;
  }

  /**
  * Tracking controller for route /track
  *
  * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
  */
  public function handle()
  {
    $text = '';
    if ($this->config['unimatrix_tracking_session_sync']) {
      $sid = $this->user->session_id;
      $text = "(function() {var my_session = '$sid';";
      $text .= "if (phpbb3_session != my_session) {window.location.reload();};";
      $text .= "})();";
    }

    return new \Symfony\Component\HttpFoundation\Response($text);
  }
}
