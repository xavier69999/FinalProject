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
	 * DESCRIPTION: JRS Controller. Included 
	 * DATE CREATED: April 21, 2018
     * DATE UPDATED: April 21, 2018
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



}