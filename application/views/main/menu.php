

<div class="requestMenu">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/thirdparty/easyui/jquery.easyui.min.js"></script>
	<script src="<?php echo base_url();?>assets/scripts/triunejrs.js"></script>

    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" style="padding:5px;">
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm1'">BAM JRS</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm2'">ICT JRS</a>
    </div>
    <div id="mm1" class="requestMenu">
        <div data-options="" select-item="bamjrs/create">Create New Requests</div>

        <div class="menu-sep"></div>
        <div select-item="bamjrs/getMyRequestList">My Requests</div>
        <div>
            <span>Requests Queue</span>
            <div class="requestMenu">
                <div select-item="bamjrs/getNewRequestList">New Requests</div>
                <div select-item="bamjrs/getOpenList">Open Requests</div>
                <div select-item="bamjrs/approved">Approved Requests</div>
                <div select-item="bamjrs/set">Set Requests</div>
                <div select-item="bamjrs/wip">WIP Requests</div>
                <div select-item="bamjrs/returned">Returned Requests</div>
                <div select-item="bamjrs/closed">Closed Requests</div>
                <div select-item="bamjrs/completed">Completed Requests</div>
            </div>
        </div>
        <div class="menu-sep"></div>
        <div select-item="">Create Job Order</div>
        <div select-item="">Job Order Queue</div>

        <div>
            <span>Job Order Reports</span>
            <div class="requestMenu">
                <div select-item="">Job Order Reports</div>
                <div select-item="">Job Order Evaluation Reports</div>
            </div>
        </div>
        <div class="menu-sep"></div>
        <div select-item="">Create Materials Estimation</div>
        <div select-item="">Materials Estimation Queue</div>
        <div select-item="">Materials Estimation Reports</div>
        <div class="menu-sep"></div>
        <div>
            <span>System Maintenance</span>
            <div class="requestMenu">
                <div select-item="">Tag Reference</div>
                <div select-item="">Station</div>
                <div select-item="">Authorized Personnel</div>
                <div select-item="">Job Description Reference</div>
                <div select-item="">Job Order Number</div>
                <div select-item="">Job Requisition Number</div>
                <div select-item="">BAM Personnel/worker</div>
                <div select-item="">Materials reference</div>
                <div select-item="">Job order evaluation questions reference</div>
                <div select-item="">Location reference</div>
                <div select-item="">Rooms</div>
            
            </div>
        </div>
    </div>

    <div id="mm2" style="width:200px;" class="requestMenu">
        <div select-item="">Create New Request</div>
        <div class="menu-sep"></div>
        <div select-item="">My Requests</div>
        <div>
            <span>Requests Queue</span>
            <div class="requestMenu">
                <div select-item="">New Requests</div>
                <div select-item="">Assigned Requests</div>
                <div select-item="">For Approval Requests</div>
                <div select-item="">Closed Requests</div>
                <div select-item="">Completed Requests</div>
            </div>
        </div>
    </div>

</div>

