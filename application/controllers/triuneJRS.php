<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class triuneJRS extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		https://tua.edu.ph/triune/auth
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://tua.edu.ph/triune
	 *
	 * AUTHOR: Randy D. Lagdaan
	 * DESCRIPTION: JRS Controller.  
	 * DATE CREATED: April 21, 2018
     * DATE UPDATED: May 14, 2018
	 */

    function __construct() {
        parent::__construct();
		$this->load->library('session');
    }//function __construct()


    public function BAMCreateRequest() {
        $this->load->view('bamjrs/create');
    }

    public function BAMCreateRequestConfirmation() {
		$data['locationCode'] = $_POST["locationCode"];
		$data['floor'] = $_POST["floor"];
		$data['roomNumber'] = $_POST["roomNumber"];
		$data['projectTitle'] = $_POST["projectTitle"];
		$data['scopeOfWorks'] = $_POST["scopeOfWorks"];
		$data['projectJustification'] = $_POST["projectJustification"];
		$data['dateNeeded'] = $_POST["dateNeeded"];


        $this->load->view('bamjrs/createConfirmation', $data);
    }

    public function BAMCreatedRequest() {
		$data['ID'] = $_POST["ID"];
        $this->load->view('bamjrs/createdRequest', $data);
    }

	public function BAMMyRequestList() {
        $this->load->view('bamjrs/listMyRequest');
	}

	public function BAMNewRequestList() {
		$data['requestStatus'] = 'N';
        $this->load->view('bamjrs/listRequest', $data);
	}


	public function BAMNewRequestVerification() {

		$data['ID'] = $_POST["ID"];

		$results = $this->_getRecordsData($rec = array('*'), 
		$tables = array('triune_job_request_transaction_bam'), 
		$fieldName = array('ID'), $where = array($data['ID']), 
		$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
		$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, 
		$groupBy = null );


		$data['locationCode'] = $results[0]->locationCode;
		$data['floor'] = $results[0]->floor;
		$data['roomNumber'] = $results[0]->roomNumber;
		$data['projectTitle'] = $results[0]->projectTitle;
		$data['scopeOfWorks'] = $results[0]->scopeOfWorks;
		$data['projectJustification'] = $results[0]->projectJustification;
		$data['dateNeeded'] = $results[0]->dateNeeded;
		$data['dateCreated'] = $results[0]->dateCreated;
		$data['requestStatus'] = $results[0]->requestStatus;

		$results1 = $this->_getRecordsData($rec = array('*'), 
		$tables = array('triune_job_request_transaction_bam_attachments'), 
		$fieldName = array('requestNumber'), $where = array($data['ID']), 
		$join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
		$limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, 
		$groupBy = null );
		
		$data['attachments'] = $results1;
		$data['requestStatusDescription'] = $this->_getRequestStatusDescription($data['requestStatus'], 'BAM');

        $this->load->view('bamjrs/requestNewVerification', $data);

	}
}