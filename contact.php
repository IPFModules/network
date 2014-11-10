<?php
/**
* Contact page
*
* @copyright	Madfish (Simon Wilkinson)
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
* @package		network
* @version		$Id$
*/

include_once "header.php";

$xoopsOption["template_main"] = "network_contact.html";
include_once ICMS_ROOT_PATH . "/header.php";

$network_contact_handler = icms_getModuleHandler("contact", basename(dirname(__FILE__)), "network");

/** Use a naming convention that indicates the source of the content of the variable */
$clean_contact_id = isset($_GET["contact_id"]) ? (int)$_GET["contact_id"] : 0 ;
$contactObj = $network_contact_handler->get($clean_contact_id);

if($contactObj && !$contactObj->isNew()) {
	$icmsTpl->assign("network_contact", $contactObj->toArray());

	$icms_metagen = new icms_ipf_Metagen($contactObj->getVar("firstname"), $contactObj->getVar("meta_keywords", "n"), $contactObj->getVar("meta_description", "n"));
	$icms_metagen->createMetaTags();
} else {
	$icmsTpl->assign("network_title", _MD_NETWORK_ALL_CONTACTS);

	$objectTable = new icms_ipf_view_Table($network_contact_handler, FALSE, array());
	$objectTable->isForUserSide();
	$objectTable->addColumn(new icms_ipf_view_Column("firstname"));
	$icmsTpl->assign("network_contact_table", $objectTable->fetch());
}

$icmsTpl->assign("network_module_home", '<a href="' . ICMS_URL . "/modules/" . icms::$module->getVar("dirname") . '/">' . icms::$module->getVar("name") . "</a>");

include_once "footer.php";