
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
                    <input class="easyui-combobox" name="location" id="location" style="width:100%;" prompt="LOCATION:" data-options="
                            url:'getLocation',
                            method:'get',
                            valueField:'locationCode',
                            textField:'locationDescription',
                            onSelect: function(rec){
                                var url = 'getFloor?locationCode='+rec.locationCode;
                                console.log( $('#floor').attr('prompt'));
                                $('#floor').combobox('reload', url);
                                clearForm();
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
                                var url = 'getRoom?floor='+rec.floor+'&locationCode='+rec.locationCode;
                                $('#room').combobox('reload', url);
                                $('#room').textbox('clear');
                            },
                            
                            panelHeight:'auto',
                            required:true
                            ">
                </div>


                <div style="margin-bottom:1px" class="two-column-70">
                    <input class="easyui-combobox" name="room" id="room" style="width:100%;" data-options="
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
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
        </div>
    </div>



    <script>
        function submitForm(){
            $('#ff').form('submit',{
                onSubmit:function(){
                    var validForm =  $(this).form('enableValidation').form('validate');
                    if(!validForm) {
                        return validForm;
                    } else {
                        var location = $('#location').val();
                        var floor = $('#floor').val();
                        var room = $('#room').val();
                        var projectTitle = $('#projectTitle').val();
                        var scopeOfWorks = $('#scopeOfWorks').val();
                        var projectJustification = $('#projectJustification').val();
                        var dateNeeded = $('#dateNeeded').val();

                        console.log(location);
                        jQuery.ajax({
                            url: "setRequestBAM",
                            data:'location='+location+'&floor='+floor+'&room='+room+'&projectTitle='+projectTitle+'&scopeOfWorks='+scopeOfWorks+'&projectJustification='+projectJustification+'&dateNeeded='+dateNeeded,
                            type: "POST",
                            success:function(data){
                                console.log('DATA');
                                console.log(data);
                                if(data == 0) {
                                    alert('0');
                                    return false;
                                }

                            },
                                error:function (){}
                        });
                    }

                }
            });
        }
    
        function clearForm(){
            console.log($('#ff').form());
            $('#ff').form('clear');
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

 <!--      <div class="easyui-panel" title="Nested Panel" style="width:700px;height:200px;padding:10px;">
        <div class="easyui-layout" data-options="fit:true">
            <div data-options="region:'west',split:true, border:false" style="width:100px;padding:10px">
                Left Content
            </div>
            <div data-options="region:'east'" style="width:100px;padding:10px">
                Right Content
            </div>
            <div data-options="region:'center'" style="padding:10px">
                Center Content
            </div>
        </div>
    </div> -->

</div>