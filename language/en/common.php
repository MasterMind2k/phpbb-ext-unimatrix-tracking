<?php
/**
 *
 * @package phpBB Extension - Unimatrix Tracking
 * @copyright (c) 2015 Gregor Kališnik
 * @copyright (c) 2015 Unimatrix
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

if (!defined('IN_PHPBB'))
  exit;

if (empty($lang) || !is_array($lang))
  $lang = array();

$lang = array_merge($lang, array(
  'TRACKING_VIEWING' => 'Viewing website',

  'NO_SUBSITES'  => 'There are no subsites, add one.',
  'SUBSITE_TEXT' => "Subsite's text",
  'SUBSITE_PATH' => "Subsite's path prefix",
  'SUBSITE_SHOW' => "Show subsite's URL",
  'ADD_SUBSITE'  => "Add new subsite",

  'ACP_TRACKING'                 => 'External website tracker',
  'ACP_TRACKING_TITLE'           => 'External website tracker settings',
  'ACP_TRACKING_SUBSITE_DELETED' => 'Subsite successfully removed.',
  'ACP_TRACKING_NEED_ID'         => "No subsite was specified.",
  'ACP_TRACKING_SUBSITE_SAVED'   => "Subsite was successfully saved.",
));
