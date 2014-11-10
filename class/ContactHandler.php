<?php
/**
 * Classes responsible for managing Network contact objects
 *
 * @copyright	Madfish (Simon Wilkinson)
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		network
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_network_ContactHandler extends icms_ipf_Handler {
	/**
	 * Constructor
	 *
	 * @param icms_db_legacy_Database $db database connection object
	 */
	public function __construct(&$db) {
		parent::__construct($db, "contact", "contact_id", "firstname", "biography", "network");

	}
	
	public function send_email_to_individual($id) {
		
	}
	
	public function send_email_to_network($tag_id) {
		
	}
	
	public function import_contacts_from_csv($file) {
		
	}
	
	// From code.stephenmorley.org/php/creating-downloadable-csv-files/
	public function export_contacts_as_csv($contacts) {

		// Allow for submission of both single contacts and arrays of contacts
		if (!is_array($contacts)) {
			$contacts = array(0 => $contacts);
		}
		
		// Output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Displosition: attachment; filename=contacts.csv');
		
		// Create a file pointer connected to the output stream
		$output = fopen('php://output','w');
		
		// Specify the field names to be used as column headings
		$headings = array(
			'Title',
			'First name',
			'Middle name(s)',
			'Last name',
			'Job title',
			'Department',
			'Organisation',
			'Postal address',
			'City',
			'Post code',
			'Country',
			'Phone',
			'Fax',
			'Email',
			'Website'
			);
		
		// Output the column headings
		fputcsv($output, $headings);		
		
		// Loop through the data outputting required fields / rows (add output buffering to this)
		foreach ($contacts as $contact) {
			$output = '';
			$output['Title'] = $contact->getVar('title');		
			fputcsv($output, $row);
		}
	}
	
	public function export_contacts_as_vcard($ids = FALSE) {
		
	}
	
	/**
	 * Provides human readable title options
	 * 
	 * @return string
	 */
	public function get_title_options() {
		return array(
			0 => _CO_NETWORK_CONTACT_DR, 
			1 => _CO_NETWORK_CONTACT_PROFESSOR, 
			2 => _CO_NETWORK_CONTACT_MR, 
			3 => _CO_NETWORK_CONTACT_MS,
			4 => _CO_NETWORK_CONTACT_MRS
			);
	}
	
	/**
     * Load tags linked to this publication
     *
     * @return void
     */
     public function loadTags() {
          
        $ret = array();
          
        // Retrieve the tags for this object
        $sprocketsModule = icms_getModuleInfo('sprockets');
        if (icms_get_module_status("sprockets")) {
             $sprockets_taglink_handler = icms_getModuleHandler('taglink',
                       $sprocketsModule->getVar('dirname'), 'sprockets');
             $ret = $sprockets_taglink_handler->getTagsForObject($this->id(), $this->handler, '0'); // label_type = 0 means only return tags
             $this->setVar('tag', $ret);
        }
     }
	
	/**
	 * Handles actions that need to be carried out (in this case, tags)
	 * 
	 * @param type $obj
	 * @return type 
	 */
	protected function afterSave(& $obj)
    {         
        $sprockets_taglink_handler = '';
        $sprocketsModule = icms::handler("icms_module")->getByDirname("sprockets");
         
        // Only update the taglinks if the object is being updated from the add/edit form (POST).
        // Database updates are not permitted from GET requests and will trigger an error
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && icms_get_module_status("sprockets")) {
			$sprockets_taglink_handler = icms_getModuleHandler('taglink',
				$sprocketsModule->getVar('dirname'), $sprocketsModule->getVar('dirname'), 
				'sprockets');
              
             // Store tags
             $sprockets_taglink_handler->storeTagsForObject($obj, 'tag', '0');
        }
    
        return TRUE;
    }
	
	/**
     * Deletes notification subscriptions and taglinks, called when an object is deleted
     *
     * @param object $obj object
     * @return bool
     */
     protected function afterDelete(& $obj) {
         
        $sprocketsModule = $notification_handler = $module_handler = $module = $module_id
	             = $tag= $item_id = '';
         
        $sprocketsModule = icms_getModuleInfo('sprockets');

        // Delete taglinks
        if (icms_get_module_status("sprockets")) {
             $sprockets_taglink_handler = icms_getModuleHandler('taglink',
                       $sprocketsModule->getVar('dirname'), 'sprockets');
             $sprockets_taglink_handler->deleteAllForObject($obj);
        }
         
        return TRUE;
     }
}