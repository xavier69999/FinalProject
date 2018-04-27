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
     * DATE UPDATED: April 26, 2018
	 */

    function __construct() {
        parent::__construct();
		$this->load->library('session');
        $this->load->library('form_validation'); 
    }//function __construct()


    public function getLocationCode() {
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

	public function getRoomNumber() {
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

		$this->form_validation->set_rules('locationCode', 'Location Code', 'required|alpha_numeric');
		$this->form_validation->set_rules('floor', 'Floor', 'required|alpha_numeric');  
		$this->form_validation->set_rules('roomNumber', 'Room Number', 'required');    
		$this->form_validation->set_rules('projectTitle', 'Project Title', 'required');    
		$this->form_validation->set_rules('scopeOfWorks', 'Scope of Works', 'required');    
		$this->form_validation->set_rules('projectJustification', 'Project Justification', 'required');    
		$this->form_validation->set_rules('dateNeeded', 'Date Needed', 'required|regex_match[/\d{4}\-\d{2}-\d{2}/]');    

		$locationCode = $_POST["locationCode"];
		$floor = $_POST["floor"];
		$roomNumber = $_POST["roomNumber"];
		$projectTitle = $_POST["projectTitle"];
		$scopeOfWorks = $_POST["scopeOfWorks"];
		$projectJustification = $_POST["projectJustification"];
		$dateNeeded = $_POST["dateNeeded"];

		$this->session->set_flashdata('locationCode', $locationCode);
		$this->session->set_flashdata('floor', $floor);
		$this->session->set_flashdata('roomNumber', $roomNumber);
		$this->session->set_flashdata('projectTitle', $projectTitle);
		$this->session->set_flashdata('scopeOfWorks', $scopeOfWorks);
		$this->session->set_flashdata('projectJustification', $projectJustification);
		$this->session->set_flashdata('dateNeeded', $dateNeeded);


		if ($this->form_validation->run() == FALSE) {   
			echo json_encode($this->form_validation->error_array());
		}else{    

			$resultsLoc = $this->_getRecordsData($data = array('locationCode'), 
			$tables = array('triune_location'), $fieldName = array('locationCode'), $where = array($locationCode), 
			$join = null, $joinType = null, $sortBy = null, $sortOrder = array('asc'), 
			$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

			$resultsRm = $this->_getRecordsData($data = array('roomNumber', 'roomDescription'), 
			$tables = array('triune_rooms'), $fieldName = array('roomNumber'), $where = array($roomNumber), 
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
			$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

			$resultsFlr = $this->_getRecordsData($data = array('roomNumber', 'roomDescription'), 
			$tables = array('triune_rooms'), $fieldName = array('floor'), $where = array($floor), 
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
			$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

			$notExistMessage = array();
			if(empty($resultsLoc)) {
				$notExistMessage["locationCodeNotExist"] = "No reference for location codes in the database!";
			} 
			
			if(empty($resultsRm)) {
				$notExistMessage["roomNumberNotExist"] = "No reference for room numbers in the database!";

			} 
			
			if(empty($resultsFlr)) {
				$notExistMessage["floorNotExist"] = "No reference for floor in the database!";

			} 
			if(count($notExistMessage) > 0) {
				echo json_encode($notExistMessage);
			} elseif(count($notExistMessage) == 0) {

				/*$userName = $this->_getUserName(1);

				$transactionExist = $this->_getRecordsData($data = array('locationCode'), 
				$tables = array('triune_job_request_transaction_bam'), 
				$fieldName = array('locationCode', 'floor', 'roomNumber', 'projectTitle', 'scopeOfWorks', 'projectJustification', 'dateNeeded', 'userName'), 
				$where = array($locationCode, $floor, $roomNumber, $projectTitle, $scopeOfWorks, $projectJustification, $dateNeeded, $userName), 
				$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
				$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );
		

				if(empty($transactionExist)) {
					$insertData = null;
					$insertData = array(
						'locationCode' => $locationCode,
						'floor' => $floor,
						'roomNumber' => $roomNumber,
						'projectTitle' => $projectTitle,
						'scopeOfWorks' => $scopeOfWorks, 
						'projectJustification' => $projectJustification,
						'requestStatus' => $this->_getRequestStatus('NEW', 'BAM'),
						'dateNeeded' => $dateNeeded,
						'dateCreated' => $this->_getCurrentDate(),
						'userName' => $userName,
						'workstationID' => $this->_getIPAddress(),
						'timeStamp' => $this->_getTimeStamp(),
					);				 
					$this->_insertRecords($tableName = 'triune_job_request_transaction_bam', $insertData);        			 

					$insertedRecord = $this->_getRecordsData($data = array('ID'), 
					$tables = array('triune_job_request_transaction_bam'), 
					$fieldName = array('locationCode', 'floor', 'roomNumber', 'projectTitle', 'scopeOfWorks', 'projectJustification', 'dateNeeded', 'userName'), 
					$where = array($locationCode, $floor, $roomNumber, $projectTitle, $scopeOfWorks, $projectJustification, $dateNeeded, $userName), 
					$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
					$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );
					
					$returnValue = array();
	
					$returnValue['ID'] = $insertedRecord[0]->ID;*/
					$returnValue = array();
					
					$returnValue['locationCode'] = $locationCode;
					$returnValue['floor'] = $floor;
					$returnValue['roomNumber'] = $roomNumber;
					$returnValue['projectTitle'] = $projectTitle;
					$returnValue['scopeOfWorks'] = $scopeOfWorks;
					$returnValue['projectJustification'] = $projectJustification;
					$returnValue['dateNeeded'] = $dateNeeded;


					$returnValue['success'] = 1;
					echo json_encode($returnValue);
				//}
			}
			
		}	

	}

	public function insertRequestBAM() {
		$locationCode = $_POST["locationCode"];
		$floor = $_POST["floor"];
		$roomNumber = $_POST["roomNumber"];
		$projectTitle = $_POST["projectTitle"];
		$scopeOfWorks = $_POST["scopeOfWorks"];
		$projectJustification = $_POST["projectJustification"];
		$dateNeeded = $_POST["dateNeeded"];
		
		$userName = $this->_getUserName(1);

		$transactionExist = $this->_getRecordsData($data = array('locationCode'), 
		$tables = array('triune_job_request_transaction_bam'), 
		$fieldName = array('locationCode', 'floor', 'roomNumber', 'projectTitle', 'scopeOfWorks', 'projectJustification', 'dateNeeded', 'userName'), 
		$where = array($locationCode, $floor, $roomNumber, $projectTitle, $scopeOfWorks, $projectJustification, $dateNeeded, $userName), 
		$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
		$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );
		

		if(empty($transactionExist)) {
			$insertData = null;
			$insertData = array(
				'locationCode' => $locationCode,
				'floor' => $floor,
				'roomNumber' => $roomNumber,
				'projectTitle' => $projectTitle,
				'scopeOfWorks' => $scopeOfWorks, 
				'projectJustification' => $projectJustification,
				'requestStatus' => $this->_getRequestStatus('NEW', 'BAM'),
				'dateNeeded' => $dateNeeded,
				'dateCreated' => $this->_getCurrentDate(),
				'userName' => $userName,
				'workstationID' => $this->_getIPAddress(),
				'timeStamp' => $this->_getTimeStamp(),
			);				 
			$this->_insertRecords($tableName = 'triune_job_request_transaction_bam', $insertData);        			 

			$insertedRecord = $this->_getRecordsData($data = array('ID'), 
			$tables = array('triune_job_request_transaction_bam'), 
			$fieldName = array('locationCode', 'floor', 'roomNumber', 'projectTitle', 'scopeOfWorks', 'projectJustification', 'dateNeeded', 'userName'), 
			$where = array($locationCode, $floor, $roomNumber, $projectTitle, $scopeOfWorks, $projectJustification, $dateNeeded, $userName), 
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
			$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );
					
			$returnValue = array();
	
			$returnValue['ID'] = $insertedRecord[0]->ID;
			$returnValue['success'] = 1;
			echo json_encode($returnValue);
		}

	}
}