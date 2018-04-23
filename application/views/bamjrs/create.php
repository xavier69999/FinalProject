
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
                    <input class="easyui-combobox" name="location" style="width:100%;" data-options="
                            url:'getLocation',
                            method:'get',
                            valueField:'locationCode',
                            textField:'locationDescription',
                            panelHeight:'auto',
                            prompt: 'LOCATION:',
                            ">
                </div>


                <div style="margin-bottom:1px" class="two-column-30">
                    <input class="easyui-combobox" name="floor" style="width:70%;" data-options="
                            url:'getFloor',
                            method:'get',
                            valueField:'floor',
                            textField:'floor',
                            panelHeight:'auto',
                            prompt: 'FLOOR:',
                            ">
                </div>


                <div style="margin-bottom:1px" class="two-column-70">
                    <input class="easyui-combobox" name="room" style="width:100%;" data-options="
                            url:'getRoom',
                            method:'get',
                            valueField:'roomNumber',
                            textField:'roomDescription',
                            panelHeight:'auto',
                            prompt: 'ROOM:',
                            ">
                </div>

            </div>
            <div style="margin-bottom:1px">
                <input class="easyui-textbox" name="projectTitle" style="width:100%" data-options="prompt:'PROJECT TITLE:',required:true">

            </div>
            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-textbox" name="scopeOfWorks" style="width:100%;height:100px" data-options="prompt:'SCOPE OF WORKS:', multiline:true">
            </div>
            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-textbox" name="projectJustification" style="width:100%;height:100px" data-options="prompt:'PROJECT JUSTIFICATION, NOTES, AND COMMENTS:',multiline:true">
            </div>

            <div style="margin-bottom:1px" class="two-column">
           
                <input id="f1" class="easyui-filebox" name="file1" style="width:100%" data-options="
                    prompt:'Choose an image...',
                    onChange: function(value){
                        var f = $(this).next().find('input[type=file]')[0];
                        if (f.files && f.files[0]){
                            var reader = new FileReader();
                            reader.onload = function(e){
                                $('#image1').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(f.files[0]);
                        }
                    }">     
                    <img id="image1" style="width:25%"/>       
            </div>
            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-filebox"  data-options="prompt:'Choose a file...'" style="width:100%">           
            </div>
           
            <div style="margin-bottom:1px" class="two-column">
                <input class="easyui-datebox" prompt="DATE NEEDED:" data-options="formatter:myformatter,parser:myparser" style="width:100%;">
            </div>
            <div style="margin-bottom:1px" class="two-column">
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
                    return $(this).form('enableValidation').form('validate');
                }
            });
        }
        function clearForm(){
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