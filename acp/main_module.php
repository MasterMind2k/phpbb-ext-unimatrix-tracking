<?php
/**
 *
 * @package phpBB Extension - Acme Demo
 * @copyright (c) 2013 phpBB Group
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace unimatrix\tracking\acp;

class main_module
{
  public $u_action;

  function main($id, $mode)
  {
    global $db, $user, $auth, $template, $cache, $request, $table_prefix;
    global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

    $user->add_lang('acp/common');
    $user->add_lang_ext('unimatrix/tracking', 'common');

    $action = request_var('action', '');

    // Get subsite id
    if (in_array($action, array('edit', 'delete'))) {
      $subsite_id = (int) request_var('id', 0);
      if (!$subsite_id)
        trigger_error($user->lang('ACP_TRACKING_NEED_ID') . adm_back_link($this->u_action), E_USER_ERROR);
    } else {
      $subsite_id = false;
    }

    switch ($action) {
      case 'edit':
      case 'add':
        // Edit/Add form
        $this->tpl_name = 'tracking_edit';
        $this->page_title = $user->lang('ACP_TRACKING_TITLE');

        add_form_key('unimatrix/tracking');
        if ($request->is_set_post('submit')) {
          // Submit changes
          if (!check_form_key('unimatrix/tracking'))
            trigger_error('FORM_INVALID', E_USER_ERROR);

          $subsite = array(
            'subsite_text' => $request->variable('subsite_text', ''),
            'subsite_path' => $request->variable('subsite_path', ''),
            'subsite_show' => (bool) $request->variable('subsite_show', '')
          );

          if ($subsite_id !== false) {
            // Edit
            $sql = 'UPDATE ' . $table_prefix . 'unimatrix_tracking_subsites SET ' . $db->sql_build_array('UPDATE', $subsite) . ' WHERE subsite_id = ' . (int) $subsite_id;
          } else {
            // Addition
            $sql = 'INSERT INTO ' . $table_prefix . 'unimatrix_tracking_subsites ' . $db->sql_build_array('INSERT', $subsite);
          }
          $db->sql_query($sql);
          trigger_error($user->lang('ACP_TRACKING_SUBSITE_SAVED') . adm_back_link($this->u_action));
        } else if ($subsite_id !== false) {
          // Get data for edit form
          $sql = 'SELECT *
                  FROM ' . $table_prefix . 'unimatrix_tracking_subsites
                  WHERE subsite_id = ' . $subsite_id;
          $result = $db->sql_query($sql);

          $subsite = $db->sql_fetchrow($result);
          $db->sql_freeresult($result);

          $template->assign_vars(array(
            'SUBSITE_TEXT' => $subsite['subsite_text'],
            'SUBSITE_PATH' => $subsite['subsite_path'],
            'SUBSITE_SHOW' => $subsite['subsite_show'],
          ));
        }

        $edit_id = '';
        if ($action == 'edit')
          $edit_id = "&amp;id=$subsite_id";

        $template->assign_vars(array(
          'U_ACTION'        => $this->u_action . "&amp;action={$action}{$edit_id}",
          'U_BACK'          => $this->u_action,
          'EDIT'            => $action == 'edit',
        ));
        break;
      case 'delete':
        if (confirm_box(true)) {
          // Delete
          $sql = "DELETE FROM {$table_prefix}unimatrix_tracking_subsites WHERE subsite_id = $subsite_id";
          $db->sql_query($sql);

          trigger_error($user->lang('ACP_TRACKING_SUBSITE_DELETED') . adm_back_link($this->u_action));
        } else {
          $s_hidden_fields = build_hidden_fields(array(
            'submit' => true,
          ));
          confirm_box(false, $user->lang['CONFIRM_OPERATION'], $s_hidden_fields);

          // Redirect
          redirect($this->u_action);
        }

        break;
      default:
        // Main list of subsites
        $this->tpl_name = 'tracking_list';
        $this->page_title = $user->lang('ACP_TRACKING_TITLE');

        // TODO Add pagination, probably needed?
        $sql = 'SELECT *
                FROM ' . $table_prefix . 'unimatrix_tracking_subsites';
        $result = $db->sql_query($sql);

        while ($subsite = $db->sql_fetchrow($result)) {
          $template->assign_block_vars('subsite', array(
            'ID'   => $subsite['subsite_id'],
            'TEXT' => $subsite['subsite_text'],
            'PATH' => $subsite['subsite_path'],
            'SHOW' => $subsite['subsite_show'],
          ));
        }

        $db->sql_freeresult($result);

        $template->assign_vars(array(
          'U_ADD_SUBSITE'    => $this->u_action . '&amp;action=add',
          'U_EDIT_SUBSITE'   => $this->u_action . '&amp;action=edit&amp;id=',
          'U_DELETE_SUBSITE' => $this->u_action . '&amp;action=delete&amp;id=' . $subsite_id,
        ));
      break;
    }
  }
}
