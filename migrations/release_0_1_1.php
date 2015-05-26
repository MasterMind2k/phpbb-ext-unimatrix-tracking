<?php
/**
 *
 * @package phpBB Extension - Unimatrix Tracking
 * @copyright (c) 2015 Gregor Kališnik
 * @copyright (c) 2015 Unimatrix
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace unimatrix\tracking\migrations;

class release_0_1_1 extends \phpbb\db\migration\migration
{

  public function effectively_installed()
  {
    return isset($this->config['unimatrix_tracking_session_sync']);
  }

  static public function depends_on()
  {
    return array('\unimatrix\tracking\migrations\release_0_1_0');
  }

  public function update_data()
  {
    return array(
      array('config.add', array('unimatrix_tracking_session_sync', 0)),
    );
  }

}
