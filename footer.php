<?php
/**
 * Footer page included at the end of each page on user side of the mdoule
 *
 * @copyright	Madfish (Simon Wilkinson)
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		network
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

$icmsTpl->assign("network_adminpage", "<a href='" . ICMS_URL . "/modules/" . icms::$module->getVar("dirname") . "/admin/index.php'>" ._MD_NETWORK_ADMIN_PAGE . "</a>");
$icmsTpl->assign("network_is_admin", icms_userIsAdmin(NETWORK_DIRNAME));
$icmsTpl->assign('network_url', NETWORK_URL);
$icmsTpl->assign('network_images_url', NETWORK_IMAGES_URL);

$xoTheme->addStylesheet(NETWORK_URL . 'module' . ((defined("_ADM_USE_RTL") && _ADM_USE_RTL) ? '_rtl' : '') . '.css');

include_once ICMS_ROOT_PATH . '/footer.php';