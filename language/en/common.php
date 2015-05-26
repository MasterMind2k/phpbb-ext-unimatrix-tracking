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
  'SUBSITE_TEXT' => "Text",
  'SUBSITE_PATH' => "Path prefix",
  'SUBSITE_SHOW' => "Show URL",
  'ADD_SUBSITE'  => "Add new subsite",
  'SUBSITES'     => "Subsites",

  'ENABLE_TRANSLATIONS'             => "Enable subsite translations",
  'ENABLE_TRANSLATIONS_DESCRIPTION' => "You need to ensure you have subsites.php translation file in your translations, otherwise view online page won't work.",
  'ENABLE_SESSION_SYNC'             => "Enable session sync",
  'ENABLE_SESSION_SYNC_DESCRIPTION' => "Included script will read external website's session id from variable <b>phpbb3_session</b>, and if it is a mismatch, it will issue a reload of the page.",

  'ACP_TRACKING'                 => 'Settings',
  'ACP_TRACKING_TITLE'           => 'External website tracker',
  'ACP_TRACKING_SUBSITE_DELETED' => 'Subsite successfully removed.',
  'ACP_TRACKING_NEED_ID'         => "No subsite was specified.",
  'ACP_TRACKING_SUBSITE_SAVED'   => "Subsite was successfully saved.",
  'ACP_TRACKING_SAVED'           => "General external tracker settings saved.",
));
