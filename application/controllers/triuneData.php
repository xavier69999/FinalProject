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
        $this->load->library('form_validation'); 
    }//function __construct()


    public function getLocation() {
		$results = $this->_getRecordsData($data = array('locationCode', 'locationDescription'), 
			$tables = array('triune_location'), $fieldName = null, $where = null, $join = null, $joinType = null, 
			$sortBy = array('locationDescription'), $sortOrder = array('asc'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

			echo json_encode($results);
	}

    public function getFloor() {
		$locationCode = $_GET["locationCode"];
		//echo $locationCode;
		$results = $this->_getRecordsData($data = array('floor', 'locationCode'), 
			$tables = array('triune_rooms'), $fieldName = array('locationCode'), $where = array($locationCode), $join = null, $joinType = null, 
			$sortBy = array('floor'), $sortOrder = array('asc'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

			echo json_encode($results);
	}

	public function getRoom() {
		$floor = $_GET["floor"];
		$locationCode = $_GET["locationCode"];

		$results = $this->_getRecordsData($data = array('roomNumber', 'roomDescription'), 
			$tables = array('triune_rooms'), $fieldName = array('floor', 'locationCode'), $where = array($floor, $locationCode), $join = null, $joinType = null, 
			$sortBy = array('roomNumber'), $sortOrder = array('asc'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

			echo json_encode($results);
	}


	public function setRequestBAM() {

		$this->form_validation->set_rules('location', 'Location', 'required|alpha_numeric');
		$this->form_validation->set_rules('floor', 'Floor', 'required|alpha_numeric');  
		$this->form_validation->set_rules('room', 'Room', 'required');    
		$this->form_validation->set_rules('scopeOfWorks', 'Scope of Works', 'required');    
		$this->form_validation->set_rules('projectJustification', 'Project Justification', 'required');    
		$this->form_validation->set_rules('dateNeeded', 'Date Needed', 'required|regex_match[/\d{4}\-\d{2}-\d{2}/]');    

		$location = $_POST["location"];
		$floor = $_POST["floor"];
		$room = $_POST["room"];
		$scopeOfWorks = $_POST["scopeOfWorks"];
		$projectJustification = $_POST["projectJustification"];
		$dateNeeded = $_POST["dateNeeded"];

		$this->session->set_flashdata('location', $location);
		$this->session->set_flashdata('floor', $floor);
		$this->session->set_flashdata('room', $room);
		$this->session->set_flashdata('scopeOfWorks', $scopeOfWorks);
		$this->session->set_flashdata('projectJustification', $projectJustification);
		$this->session->set_flashdata('dateNeeded', $dateNeeded);


		if ($this->form_validation->run() == FALSE) {   
			echo json_encode($this->form_validation->error_array());
		}else{    

			$resultsLoc = $this->_getRecordsData($data = array('locationCode'), 
			$tables = array('triune_location'), $fieldName = array('locationCode'), $where = array($location), 
			$join = null, $joinType = null, $sortBy = null, $sortOrder = array('asc'), 
			$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

			$resultsRm = $this->_getRecordsData($data = array('roomNumber', 'roomDescription'), 
			$tables = array('triune_rooms'), $fieldName = array('roomNumber'), $where = array($room), 
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
			$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

			$resultsFlr = $this->_getRecordsData($data = array('roomNumber', 'roomDescription'), 
			$tables = array('triune_rooms'), $fieldName = array('floor'), $where = array($floor), 
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
			$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

			if(empty($resultsLoc)) {
				echo "{'locationNotExist' : 'location not exist!'}";
			} elseif(empty($resultsRm)) {
				echo "{'roomNotExist' : 'room not exist!'}";
			} elseif(empty($resultsFlr)) {
				echo "{'floorNotExist' : 'floor not exist!'}";
			} else {
				echo 1;
			}

			
		}	

	}
}