<?php
/**
 * Admin page to manage contacts
 *
 * List, add, edit and delete contact objects
 *
 * @copyright	Madfish (Simon Wilkinson)
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		network
 * @version		$Id$
 */

/**
 * Edit a Contact
 *
 * @param int $contact_id Contactid to be edited
*/
function editcontact($contact_id = 0) {
	global $network_contact_handler, $icmsModule, $icmsAdminTpl;

	$contactObj = $network_contact_handler->get($contact_id);

	if (!$contactObj->isNew()){
		$icmsModule->displayAdminMenu(0, _AM_NETWORK_CONTACTS . " > " . _CO_ICMS_EDITING);
		$sform = $contactObj->getForm(_AM_NETWORK_CONTACT_EDIT, "addcontact");
		$sform->assign($icmsAdminTpl);
	} else {
		$icmsModule->displayAdminMenu(0, _AM_NETWORK_CONTACTS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $contactObj->getForm(_AM_NETWORK_CONTACT_CREATE, "addcontact");
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display("db:network_admin_contact.html");
}

include_once "admin_header.php";

$network_contact_handler = icms_getModuleHandler("contact", basename(dirname(dirname(__FILE__))), "network");
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = "";
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ("mod", "changedField", "addcontact", "del", "view", "");

if (isset($_GET["op"])) $clean_op = htmlentities($_GET["op"]);
if (isset($_POST["op"])) $clean_op = htmlentities($_POST["op"]);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_contact_id = isset($_GET["contact_id"]) ? (int)$_GET["contact_id"] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
*/
if (in_array($clean_op, $valid_op, TRUE)) {
	switch ($clean_op) {
		case "mod":
		case "changedField":
			icms_cp_header();
			editcontact($clean_contact_id);
			break;

		case "addcontact":
			$controller = new icms_ipf_Controller($network_contact_handler);
			$controller->storeFromDefaultForm(_AM_NETWORK_CONTACT_CREATED, _AM_NETWORK_CONTACT_MODIFIED);
			break;

		case "del":
			$controller = new icms_ipf_Controller($network_contact_handler);
			$controller->handleObjectDeletion();
			break;

		case "view" :
			$contactObj = $network_contact_handler->get($clean_contact_id);
			icms_cp_header();
			$contactObj->displaySingleObject();
			break;

		default:
			icms_cp_header();
			$icmsModule->displayAdminMenu(0, _AM_NETWORK_CONTACTS);
			$objectTable = new icms_ipf_view_Table($network_contact_handler);
			$objectTable->addColumn(new icms_ipf_view_Column("firstname"));
			$objectTable->addColumn(new icms_ipf_view_Column("lastname"));
			$objectTable->addColumn(new icms_ipf_view_Column("job_title"));
			$objectTable->addColumn(new icms_ipf_view_Column("organisation"));
			$objectTable->addColumn(new icms_ipf_view_Column("institutionalrep"));
			$objectTable->addIntroButton("addcontact", "contact.php?op=mod", _AM_NETWORK_CONTACT_CREATE);
			$icmsAdminTpl->assign("network_contact_table", $objectTable->fetch());
			$icmsAdminTpl->display("db:network_admin_contact.html");
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */