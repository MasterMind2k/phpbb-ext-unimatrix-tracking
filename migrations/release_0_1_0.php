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

class release_0_1_0 extends \phpbb\db\migration\migration
{

  public function effectively_installed()
  {
    return $this->db_tools->sql_table_exists($this->table_prefix . 'unimatrix_tracking_subsites');
  }

  public function update_schema()
  {
    return array(
      'add_tables' => array(
        $this->table_prefix . 'unimatrix_tracking_subsites' => array(
          'COLUMNS' => array(
            'subsite_id'   => array('UINT', null, 'auto_increment'),
            'subsite_text' => array('VCHAR:255', ''),
            'subsite_path' => array('VCHAR:255', ''),
            'subsite_show' => array('BOOL', true),
          ),
          'PRIMARY_KEY' => 'subsite_id',
        ),
      ),
    );
  }

  public function update_data()
  {
    return array(
      array('module.add', array(
        'acp',
        'ACP_CAT_DOT_MODS',
        'ACP_TRACKING_TITLE'
      )),
      array('module.add', array(
          'acp',
          'ACP_TRACKING_TITLE',
        array(
          'module_basename' => '\unimatrix\tracking\acp\main_module',
          'modes'           => array('settings', 'add', 'edit'),
        ),
      )),
    );
  }

  public function revert_schema()
  {
    return array(
      'drop_tables' => array(
        $this->table_prefix . 'unimatrix_tracking_subsites',
      ),
    );
  }

}
