<?php
/**
 * Class representing Network contact objects
 *
 * @copyright	Madfish (Simon Wilkinson)
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		network
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_network_Contact extends icms_ipf_seo_Object {
	/**
	 * Constructor
	 *
	 * @param mod_network_Contact $handler Object handler
	 */
	public function __construct(&$handler) {
		icms_ipf_object::__construct($handler);

		$this->quickInitVar("contact_id", XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar("title", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("firstname", XOBJ_DTYPE_TXTBOX, TRUE);
		$this->quickInitVar("middlename", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("lastname", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->initNonPersistableVar('tag', XOBJ_DTYPE_INT, 'tag', FALSE, FALSE, FALSE, TRUE);
		$this->quickInitVar("job_title", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("department", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("organisation", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("address", XOBJ_DTYPE_TXTAREA, FALSE);
		$this->quickInitVar("city", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("postcode", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("phone", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("fax", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("email", XOBJ_DTYPE_EMAIL, FALSE);
		$this->quickInitVar("website", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("biography", XOBJ_DTYPE_TXTAREA, FALSE);
		$this->quickInitVar("institutionalrep", XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar("date", XOBJ_DTYPE_LTIME, TRUE);
		$this->initCommonVar("counter");
		$this->initCommonVar("dohtml");
		$this->initCommonVar("dobr");
		$this->initCommonVar("doimage");
		$this->initCommonVar("dosmiley");
		
		// Set controls
		$this->setControl('title', array(
			'name' => 'select',
			'itemHandler' => 'contact',
			'method' => 'get_title_options',
			'module' => 'network'));
		
		// Only display the tag fields if the sprockets module is installed
        $sprocketsModule = icms_getModuleInfo('sprockets');
        if (icms_get_module_status("sprockets")) {
             $this->setControl('tag', array(
             'name' => 'selectmulti',
             'itemHandler' => 'tag',
             'method' => 'getTags',
             'module' => 'sprockets'));
        } else {
             $this->hideFieldFromForm('tag');
             $this->hideFieldFromSingleView ('tag');
        }
		
		$this->setControl('institutionalrep', 'yesno');
		
		$this->initiateSEO();
	}

	/**
	 * Overriding the icms_ipf_Object::getVar method to assign a custom method on some
	 * specific fields to handle the value before returning it
	 *
	 * @param str $key key of the field
	 * @param str $format format that is requested
	 * @return mixed value of the field that is requested
	 */
	public function getVar($key, $format = "s") {
		if ($format == "s" && in_array($key, array())) {
			return call_user_func(array ($this,	array('title', 'date')));
		}
		return parent::getVar($key, $format);
	}
	
	/**
	 * Converts a the title field into human readable format
	 * 
	 * @return string $title
	 */
	public function title() {
		$title = $this->getVar('title', 'e');
		$title = $this->handler->get_title_options($title);
		
		return $title;
	}
	
	/**
	 * Converts a contact's last updated timestamp field into human readable format
	 * 
	 * @return type 
	 */
	public function date() {
		$date = $this->getVar('date', 'e');
		$date = icms_getConfig('date_format', 'network');
		
		return $date;
	}
}