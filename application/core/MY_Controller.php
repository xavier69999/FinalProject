<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('triuneModelMain');
        $this->load->library('encryption');		
		$this->load->helper('file');	
    }



    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial) {
        $rows = $this->triuneModelMain->getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------



    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy) {
        $rows = $this->triuneModelMain->getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------



    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _updateRecords($tableName, $fieldName, $where, $data) {
        $rows = $this->triuneModelMain->updateRecords($tableName, $fieldName, $where, $data);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------


    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE INSERT RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _insertRecords($tableName, $data) {
        $rows = $this->triuneModelMain->insertRecords($tableName, $data);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------


    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _deleteRecords($tableName, $fieldName, $where) {
        $rows = $this->triuneModelMain->deleteRecords($tableName, $fieldName, $where);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------TRIUNE UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET CURRENT DATE-------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
    function _getCurrentDate() {
        $currentDate = date('Y-m-d');
        return $currentDate;
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET CURRENT DATE-------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------


    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET TIMESTAMP-------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
    function _getTimeStamp() {
        $timeStamp = date('Y-m-d h:i:s');
        return $timeStamp;
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET TIMESTAMP-------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------



    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET USER NUMBER-------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
    function _getUserName($userType) {
        $userName = null;
        if($userType == 0) {
            $userName = "SYSGEN";
        } else {
            $userName = $this->session->userdata('userName'); //should be actual user id
        }
        return $userName;
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET USER NUMBER---------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------


    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET WORKSTATION IP ADDRESS----------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
    function _getIPAddress()  {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))  {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } //check ip from share internet
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }  //to check ip is pass from proxy
        else {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET WORKSTATION IP ADDRESS----------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET REQUEST STATUS----------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
    public function _getRequestStatus($requestStatusDescription, $application) {
        $results = $this->_getRecordsData($data = array('requestStatusCode'), 
        $tables = array('triune_request_status_reference'), $fieldName = array('requestStatusDescription', 'application'), 
        $where = array($requestStatusDescription, $application), 
        $join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
        $limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

        return $results[0]->requestStatusCode;
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET REQUEST STATUS----------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
    

    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET REQUEST STATUS DESCRIPTION------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
    public function _getRequestStatusDescription($requestStatusCode, $application) {
        $results = $this->_getRecordsData($data = array('*'), 
        $tables = array('triune_request_status_reference'), 
        $fieldName = array('requestStatusCode', 'application'), 
        $where = array($requestStatusCode, $application), 
        $join = null, $joinType = null, $sortBy = null, $sortOrder = null, 
        $limit = null, 	$fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

        return $results[0]->requestStatusDescription;
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------GET REQUEST STATUS DESCRIPTION------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------



	public function _base64urlEncode($data) { 
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
	} 


    public function _base64urlDecode($data) { 
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
	}       




    public function _isTokenValid($token) {
       $tkn = substr($token,0,30);
       $uid = substr($token,30);      
       
       
       $result = $userRecord = $this->_getRecordsData($data = array('*'), 
            $tables = array('triune_token'), 
            $fieldName = array('token', 'userID'), 
            $where = array($tkn, $uid), 
            $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
            $fieldNameLike = null, $like = null, 
            $whereSpecial = null, $groupBy = null );


        if($result) {
            $created = $result[0]->timeStamp;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);

            if($createdTS != $todayTS){
                return false;
            }

            $userInfo = $this->_getRecordsData($data = array('*'), $tables = array('triune_user'), $fieldName = array('ID'), $where = array($result[0]->userID), 
                $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
                $fieldNameLike = null, $like = null, 
                $whereSpecial = null, $groupBy = null );
            return $userInfo;
        } else {
            return false;
        }

        
    } 


    public function _sendMail($toEmail, $subject, $message) { 
  
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_port' => 587,
            'smtp_user' => 'trinityemailer@gmail.com',
            'smtp_pass' => 'tr1n1ty@1963',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'starttls'  => TRUE,
            'wordwrap' => TRUE

        );
        $this->load->library('email', $config); 
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        
        $fromEmail = "trinityemailer@gmail.com"; 
  
  
        $this->email->from($fromEmail, 'Randy Lagdaan'); 
        $this->email->to($toEmail);
        $this->email->subject($subject); 
        $this->email->message($message); 
  
        //Send mail 
        if($this->email->send()) {
            $this->session->set_flashdata("email_sent","Email sent successfully."); 
            echo "OK";
        } else {
            $this->session->set_flashdata("email_sent","Error in sending Email."); 
            echo "NOT OK";
            var_dump($this->email->send());
        }


   /*     $this->load->library('email');
        $this->email->from('trinityemailer@gmail.com'); //change it
        $this->email->to($toEmail); //change it
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send())
        {
           $data['success'] = 'Yes';
            var_dump($data);
        }
        else
        {
           $data['success'] = 'No';
           $data['error'] = $this->email->print_debugger(array(
              'headers'
           ));
           var_dump($data);           
        }
     */


     } 


     public function _insertToken($id) {
        $token = substr(sha1(rand()), 0, 30); 
        $date = date('Y-m-d');

        
        $triune_token = null;
        $triune_token = array(
              'token' => $token,
              'userID' => $id,
              'timeStamp' => $date,
        ); 
        $this->_insertRecords($tableName = 'triune_token', $triune_token);
        $token = $token . $id;
        $qstring = $this->_base64urlEncode($token);                      
        return $qstring;
     }


     public function _sendSMS() {
        $NEXMO_API_KEY =  '72d97f08';
        $NEXMO_API_SECRET = 'd3d4ea727e3ba4ca';
        $basic  = new \Nexmo\Client\Credentials\Basic($NEXMO_API_KEY, $NEXMO_API_SECRET);
        $client = new \Nexmo\Client($basic);

        $TO_NUMBER = '639175787809';
        $message = $client->message()->send([
            'to' => $TO_NUMBER,
            'from' => 'WebApp',
            'text' => 'You are now registered'
        ]);        
     }




//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------INSERT AUDIT TRAIL------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
function _insertAuditTrail($actionName, $systemForAuditName, $moduleName, $for, $oldValue, $newValue) {

    //SET AND INSERT AUDIT TRAIL RECORD
    //SETUP AUDIT TRAIL DATA AND INSERT AUDIT TRAIL
    $action = $actionName;
    $systemForAudit = $systemForAuditName;
    $module = $moduleName;
    $auditTrailData = array(
         'userName' => $this->_getUserName(1),
         'timeStamp' => $this->_getTimeStamp(),
         'dateCreated' => $this->_getCurrentDate(),
         'workstationID' => $this->_getIPAddress(),
         'system' => $systemForAudit,
         'module' => $module,
         'action' => $action,
         'oldValue' => serialize($oldValue),
         'newValue' => serialize($newValue),
         'for' => $for,
    );
    $this->_insertRecords('triune_audit_trail', $auditTrailData);
    //SET AND INSERT AUDIT TRAIL RECORD
    
}
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------INSERT AUDIT TRAIL------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------ACID TRANSACTION FAILED-------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
public function _transactionFailed() {
    $error = $this->db->error();
    $this->session->set_flashdata('Error', $error["message"]);
}
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------ACID TRANSACTION FAILED-------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------WRITE LOG FILE----------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
public function _insertTextLog($fileName, $text) {

    if ( ! write_file('./assets/logs/bamjrs/'.$fileName, $text.PHP_EOL, 'a+'))  {
         $this->_transactionFailed();
    } else  {
        return true;
    }
}
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------WRITE LOG FILE----------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------


}

