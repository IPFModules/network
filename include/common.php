<?php
/**
 * Common file of the module included on all pages of the module
 *
 * @copyright	Madfish (Simon Wilkinson)
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		network
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

if (!defined("NETWORK_DIRNAME")) define("NETWORK_DIRNAME", $modversion["dirname"] = basename(dirname(dirname(__FILE__))));
if (!defined("NETWORK_URL")) define("NETWORK_URL", ICMS_URL."/modules/".NETWORK_DIRNAME."/");
if (!defined("NETWORK_ROOT_PATH")) define("NETWORK_ROOT_PATH", ICMS_ROOT_PATH."/modules/".NETWORK_DIRNAME."/");
if (!defined("NETWORK_IMAGES_URL")) define("NETWORK_IMAGES_URL", NETWORK_URL."images/");
if (!defined("NETWORK_ADMIN_URL")) define("NETWORK_ADMIN_URL", NETWORK_URL."admin/");

// Include the common language file of the module
icms_loadLanguageFile("network", "common");