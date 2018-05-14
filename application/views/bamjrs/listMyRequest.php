<div class="requestForm">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/thirdparty/easyui/jquery.easyui.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />
    <script type="text/javascript">
        function doSearch(){
            $('#tt').datagrid('load',{
                ID: $('#ID').val(),
                locationCode: $('#locationCode').val()
            });
        }
    </script>   

<table id="tt" class="easyui-datagrid" style="width:100%;max-width:70%;padding:5px 5px;"
        url="getBAMJRSMyRequestList" toolbar="#tb"
        title="My Request List" iconCls="icon-save"
        rownumbers="true" pagination="true">

    <thead>
        <tr >
            <th field="ID" >ID</th>
            <th field="locationCode" >Location Code</th>
            <th field="projectTitle"  >Project Title</th>
            <th field="dateCreated"  align="right">Date Created</th>
            <th field="dateNeeded"  align="right">Date Needed</th>
            <th field="requestStatusDescription" >Request Status</th>

        </tr>
    </thead>
</table>
<div id="tb" style="padding:3px">
    <span>ID:</span>
    <input id="ID" style="line-height:26px;border:1px solid #ccc">
    <span>Location Code:</span>
    <input id="locationCode" style="line-height:26px;border:1px solid #ccc">
    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>

</div>

</div>