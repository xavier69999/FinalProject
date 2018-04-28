<div class="requestCreatedPanel">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/thirdparty/easyui/jquery.easyui.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />
    
    <div id="p" class="easyui-panel" title="Request Created" style="width:40%;height:200px;padding:10px;">
        <p style="font-size:18" >Your request has been created, please use request number: <b style="font-size:24"><u><?php echo $ID ?></u></b> for your reference.</p>
        <input type='hidden' id="ID" value="<?php echo $ID; ?>">
        <div class="col-md-6" align="right">
        <!--<label>Select Multiple Files</label>
        </div>
        <div class="col-md-6">
        <input type="file" name="files" id="files" multiple />
        </div>
        <div style="clear:both"></div>
        <br />
        <br />
        <div id="uploaded_images"></div>   -->

        <input multiple id="files" name="files" type="file" style="width:100%" > 
        <a id="ff" class="easyui-linkbutton"  style="width:80px">Submit</a>

    </div>
</div>
<script>

$('#ff').click(function(){
    var files = $('#files')[0].files;
    var error = '';
    var form_data = new FormData();
    for(var count = 0; count<files.length; count++) {
        var name = files[count].name;
        var extension = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1) {
            error += "Invalid " + count + "  File"
        } else  {
            form_data.append("files[]", files[count]);
        }
        console.log(files[count]);

    }
    form_data.append('ID', $("#ID").val());
    if(error == '') {
        $.ajax({
            url:'uploadFile',
            method:"POST",
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
        
            beforeSend:function() {
                $('#uploaded_images').html("<label class='text-success'>Uploading...</label>");
            },
            success:function(data) {
                $('#uploaded_images').html(data);
                $('#files').val('');
            }
        })
    } else {
        alert(error);
    }
 });
 </script>