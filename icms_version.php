<?php
/**
 * Network version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	Madfish (Simon Wilkinson)
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		network
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/**  General Information  */
$modversion = array(
	"name"						=> _MI_NETWORK_MD_NAME,
	"version"					=> 1.0,
	"description"				=> _MI_NETWORK_MD_DESC,
	"author"					=> "Madfish (Simon Wilkinson)",
	"credits"					=> "Constructed using the excellent ImBuilding module",
	"help"						=> "",
	"license"					=> "GNU General Public License (GPL)",
	"official"					=> 0,
	"dirname"					=> basename(dirname(__FILE__)),
	"modname"					=> "network",

/**  Images information  */
	"iconsmall"					=> "images/icon_small.png",
	"iconbig"					=> "images/icon_big.png",
	"image"						=> "images/icon_big.png", /* for backward compatibility */

/**  Development information */
	"status_version"			=> "1.0",
	"status"					=> "Beta",
	"date"						=> "Unreleased",
	"author_word"				=> "",
	"warning"					=> _CO_ICMS_WARNING_BETA,

/** Contributors */
	"developer_website_url"		=> "http://www.isengard.biz",
	"developer_website_name"	=> "Isengard.biz",
	"developer_email"			=> "simon@isengard.biz",

/** Administrative information */
	"hasAdmin"					=> 1,
	"adminindex"				=> "admin/index.php",
	"adminmenu"					=> "admin/menu.php",

/** Install and update informations */
	"onInstall"					=> "include/onupdate.inc.php",
	"onUpdate"					=> "include/onupdate.inc.php",

/** Search information */
	"hasSearch"					=> 0,
	"search"					=> array("file" => "include/search.inc.php", "func" => "network_search"),

/** Menu information */
	"hasMain"					=> 1,

/** Comments information */
	"hasComments"				=> 0);

/** other possible types: testers, translators, documenters and other */
$modversion['people']['developers'][] = "Madfish (Simon Wilkinson)";

/** Manual */
$modversion['manual']['wiki'][] = "<a href='http://wiki.impresscms.org/index.php?title=Network' target='_blank'>English</a>";

/** Database information */
$modversion['object_items'][1] = 'contact';

$modversion["tables"] = icms_getTablesArray($modversion['dirname'], $modversion['object_items']);

/** Templates information */
$modversion['templates'] = array(
	array("file" => "network_admin_contact.html", "description" => "contact Admin Index"),
	array("file" => "network_contact.html", "description" => "contact Index"),

	array('file' => 'network_header.html', 'description' => 'Module Header'),
	array('file' => 'network_footer.html', 'description' => 'Module Footer'));

/** Module preferences **/
$modversion['config'][] = array(
	'name' => 'date_format',
	'title' => '_MI_NETWORK_DATE_FORMAT',
	'description' => '_MI_NETWORK_DATE_FORMAT_DSC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'j/n/Y');