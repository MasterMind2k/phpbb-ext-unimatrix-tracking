<?php
/**
 *
 * @package phpBB Extension - Unimatrix Tracking
 * @copyright (c) 2015 Gregor Kališnik
 * @copyright (c) 2015 Unimatrix
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace unimatrix\tracking\acp;

class main_info
{
  function module()
  {
    return array(
      'filename' => '\unimatrix\tracking\acp\main_module',
      'title'    => 'ACP_TRACKING_TITLE',
      'version'  => '0.1.0',
      'modes'    => array(
        'settings' => array('title' => 'ACP_TRACKING', 'auth' => 'ext_unimatrix/tracking && acl_a_board', 'cat' => array('ACP_TRACKING_TITLE')),
      ),
    );
  }
}
