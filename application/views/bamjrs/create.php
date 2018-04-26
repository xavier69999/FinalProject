
<div class="requestForm">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/thirdparty/easyui/jquery.easyui.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />


    <div style="margin:5px 0;"></div>
    <div class="easyui-panel" title="Create Request" style="width:100%;max-width:50%;padding:5px 5px;"> 
        <form id="ff" class="easyui-form" method="post" data-options="novalidate:true">
            <div style="margin-bottom:5px">
                <div style="margin-bottom:1px" >
                    <input class="easyui-combobox" name="locationCode" id="locationCode" style="width:100%" prompt="LOCATION:" data-options="
                            url:'getLocationCode',
                            method:'get',
                            valueField:'locationCode',
                            textField:'locationDescription',
                            onSelect: function(rec){
                                var url = 'getFloor?locationCode='+rec.locationCode;
                                console.log( $('#floor').attr('prompt'));
                                $('#roomNumber').textbox('clear');
                                $('#floor').textbox('clear');
                                $('#floor').combobox('reload', url);
                                $('#roomNumber').combobox('reload', url);
                            },
                            panelHeight:'auto',
                            required:true
                            ">
                </div>


                <div style="margin-bottom:1px" class="two-column-30">
                    <input class="easyui-combobox" name="floor" id="floor" style="width:70%;" prompt="FLOOR:" data-options="
                            valueField:'floor',
                            textField:'floor',
                            onSelect: function(rec){
                                var url = 'getRoomNumber?floor='+rec.floor+'&locationCode='+rec.locationCode;
                                $('#roomNumber').textbox('clear');
                                $('#roomNumber').combobox('reload', url);
                            },
                            
                            panelHeight:'auto',
                            required:true
                            ">
                </div>


                <div style="margin-bottom:1px" class="two-column-70">
                    <input class="easyui-combobox" name="roomNumber" id="roomNumber" style="width:100%;" data-options="
                            valueField:'roomNumber',
                            textField:'roomDescription',
                            panelHeight:'auto',
                            prompt: 'ROOM:',
                            required:true
                            ">
                </div>

            </div>
            <div style="margin-bottom:1px">
                <input class="easyui-textbox" name="projectTitle" id="projectTitle"  style="width:100%" data-options="prompt:'PROJECT TITLE:',required:true">

            </div>
            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-textbox" name="scopeOfWorks" id="scopeOfWorks" style="width:100%;height:100px" data-options="prompt:'SCOPE OF WORKS:', multiline:true ,required:true">

            </div>
            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-textbox" name="projectJustification" id="projectJustification" style="width:100%;height:100px" data-options="prompt:'PROJECT JUSTIFICATION, NOTES, AND COMMENTS:',multiline:true,required:true">

            </div>

            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-datebox" prompt="DATE NEEDED:" id="dateNeeded" data-options="formatter:myformatter,parser:myparser,required:true" style="width:100%;">

            </div>

        </form>
        <div style="text-align:center;padding:5px 0">
            <input value="Submit" id="submitButton" onclick="submitForm()" style="width:80px">
            <!--<a href="javascript:void(0)" id="clearButton" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>-->
        </div>
    </div>

   <div id="error-messages"> </div>

    <script>
        
        function submitForm(){

            $('#ff').form('submit',{
                onSubmit:function(){
                    var validForm =  $(this).form('enableValidation').form('validate');
                    if(!validForm) {
                        return validForm;
                    } else {
                        var locationCode = $('#locationCode').val();
                        var floor = $('#floor').val();
                        var roomNumber = $('#roomNumber').val();
                        var projectTitle = $('#projectTitle').val();
                        var scopeOfWorks = $('#scopeOfWorks').val();
                        var projectJustification = $('#projectJustification').val();
                        var dateNeeded = $('#dateNeeded').val();
                        alert('hi');
                     
                        $("#submitButton").prop('disabled', true);
alert($("#submitButton"));/*
                        jQuery.ajax({
                            url: "setRequestBAM",
                            data:'locationCode='+locationCode+'&floor='+floor+'&roomNumber='+roomNumber+'&projectTitle='+projectTitle+'&scopeOfWorks='+scopeOfWorks+'&projectJustification='+projectJustification+'&dateNeeded='+dateNeeded,
                            type: "POST",
                            success:function(data){
                                console.log(data);
                                if(data == 1) {
                                    console.log('success');
                                    $('div#location-div').html('');

                                    clearErrorMessages();
                                    return true;
                                } else {

                                    var obj = $.parseJSON(data);
                                    var dateNeeded = obj['dateNeeded'];
                                    var roomNumber = obj['roomNumber'];
                                    var floor = obj['floor'];
                                    var locationCode = obj['locationCode'];
                                    var scopeOfWorks = obj['scopeOfWorks'];
                                    var projectJustification = obj['projectJustification'];
                                    var projectTitle = obj['projectTitle'];
                                    var locationCodeNotExist = obj['locationCodeNotExist'];
                                    var floorNotExist = obj['floorNotExist'];
                                    var roomNumberNotExist = obj['roomNumberNotExist'];

                                    $notExistMessage = '';
                                    if(locationCodeNotExist != undefined) {
                                        $notExistMessage =  $notExistMessage + locationCodeNotExist + "<br>";
                                    }

                                    if(floorNotExist != undefined) {
                                        $notExistMessage =  $notExistMessage + floorNotExist + "<br>";
                                    } 
                                    if(roomNumberNotExist != undefined) {
                                        $notExistMessage =  $notExistMessage + roomNumberNotExist + "<br>";
                                    } 

                                    if(dateNeeded != undefined) {
                                        $notExistMessage =  $notExistMessage + dateNeeded + "<br>";
                                    } 
                                    if(roomNumber != undefined) {
                                        $notExistMessage =  $notExistMessage + roomNumber + "<br>";
                                    } 
                                    if(floor != undefined) {
                                        $notExistMessage =  $notExistMessage + floor + "<br>";
                                    } 
                                    if(locationCode != undefined) {
                                        $notExistMessage =  $notExistMessage + locationCode + "<br>";
                                    } 
                                    if(scopeOfWorks != undefined) {
                                        $notExistMessage =  $notExistMessage + scopeOfWorks + "<br>";
                                    } 

                                    if(projectJustification != undefined) {
                                        $notExistMessage =  $notExistMessage + projectJustification + "<br>";
                                    } 

                                    if(projectTitle != undefined) {
                                        $notExistMessage =  $notExistMessage + projectTitle + "<br>";
                                    } 

                                    $('div#error-messages').html($notExistMessage);
                                    
                                    return false;

                                }

                            },
                                error:function (){}
                        });*/
                    }

                }
            });
        }
    
        function clearForm(){
            console.log($('#ff').form());
            $('#ff').form('clear');
        }

        function clearErrorMessages() {
            $('div#error-messages').html('');
        }


        function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }

    </script>


</div>