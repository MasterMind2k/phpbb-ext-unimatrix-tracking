<?php
/**
 *
 * @package phpBB Extension - Unimatrix Tracking
 * @copyright (c) 2015 Gregor Kališnik
 * @copyright (c) 2015 Unimatrix
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * Swedish translation by Holger (http://www.maskinisten.net)
 *
 */

if (!defined('IN_PHPBB'))
  exit;

if (empty($lang) || !is_array($lang))
  $lang = array();

$lang = array_merge($lang, array(
  'TRACKING_VIEWING' => 'Tittar på webbsida',

  'NO_SUBSITES'  => 'Det finns inga undersidor, lägg till en.',
  'SUBSITE_TEXT' => "Text",
  'SUBSITE_PATH' => "Sökvägens prefix",
  'SUBSITE_SHOW' => "Visa URL",
  'ADD_SUBSITE'  => "Lägg till en ny undersida",
  'SUBSITES'     => "Undersidor",

  'ENABLE_TRANSLATIONS'             => "Aktivera översättning av undersidor",
  'ENABLE_TRANSLATIONS_DESCRIPTION' => "Se till att du har översättningsfilen subsites.php i dina översättningar, annars fungerar trackingsidan ej.",

  'ACP_TRACKING'                 => 'Inställningar',
  'ACP_TRACKING_TITLE'           => 'Tracker för externa webbsidor',
  'ACP_TRACKING_SUBSITE_DELETED' => 'Undersidan har tagits bort.',
  'ACP_TRACKING_NEED_ID'         => "Undersida har ej angivits.",
  'ACP_TRACKING_SUBSITE_SAVED'   => "Undersidan har sparats.",
  'ACP_TRACKING_SAVED'           => "De generella inställningarna har sparats.",
));
