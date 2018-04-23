<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class triuneData extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		https://tua.edu.ph/triune/auth
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://tua.edu.ph/triune
	 *
	 * AUTHOR: Randy D. Lagdaan
	 * DESCRIPTION: Data Controller.  
	 * DATE CREATED: April 22, 2018
     * DATE UPDATED: April 22, 2018
	 */

    function __construct() {
        parent::__construct();
		$this->load->library('session');
    }//function __construct()


    public function getLocation() {
		$userRecord = $this->_getRecordsData($data = array('locationCode', 'locationDescription'), 
			$tables = array('triune_location'), $fieldName = null, $where = null, $join = null, $joinType = null, 
			$sortBy = array('locationDescription'), $sortOrder = array('asc'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

			echo json_encode($userRecord);
	}

    public function getFloor() {
		$userRecord = $this->_getRecordsData($data = array('floor'), 
			$tables = array('triune_rooms'), $fieldName = null, $where = null, $join = null, $joinType = null, 
			$sortBy = array('floor'), $sortOrder = array('asc'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

			echo json_encode($userRecord);
	}

	public function getRoom() {
		$userRecord = $this->_getRecordsData($data = array('roomNumber', 'roomDescription'), 
			$tables = array('triune_rooms'), $fieldName = null, $where = null, $join = null, $joinType = null, 
			$sortBy = array('roomNumber'), $sortOrder = array('asc'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

			echo json_encode($userRecord);
	}


}