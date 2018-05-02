<div class="requestCreatedPanel">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/thirdparty/easyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/thirdparty/easyui/jquery.easyui.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />
    
    <div id="p" class="easyui-panel" title="Request Created" style="width:50%;height:300px;padding:10px;">
        <p style="font-size:18" >Your request has been created, please use request number: <b style="font-size:24"><u><?php echo $ID ?></u></b> for your reference.</p>
        <input type='hidden' id="ID" value="<?php echo $ID; ?>">
<div class="two-column-70">
    <p>You may attach files to your request</p>
    <input multiple id="files" name="files" type="file"  > 
    <a id="ff" class="easyui-linkbutton">Upload</a>
    <div id="uploaded_images"></div>

</div>

<div class="two-column-30">
    <a href="" onclick="" > Proceed to MyRequest instead..</a>
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
                console.log(files.length);
                $('#uploaded_images').html('<p>The following files have been uploaded: <br>');
                for(i = 0; i < files.length; i++) {
                    $('#uploaded_images').append(files[i].name + "<br>");
                }
                $('#files').val('');
            }
        })
    } else {
        alert(error);
    }
 });
 </script>