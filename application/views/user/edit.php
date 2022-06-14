

<div class="container py-4">
<div class="row">
    <div class="col-md-12  py-4">
            <button type="button" class="btn btn-primary" id="back_btn">Back</button>
    </div>
    <div class="col-md-10 offset-md-1">
       <h1>Edit User</h1>
        <form id="form_add" method="POST" action="">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" aria-describedby="first_name" placeholder="Enter your First Name" autocomplete="off">
                
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" aria-describedby="last_name" placeholder="Enter your Last Name" autocomplete="off">
                
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" aria-describedby="position" placeholder="Enter your Position" autocomplete="off">
                
            </div>
            <input type="button" class="btn btn-success float-end" id="btn_save" value="Save">
        </form>
    </div>
</div>


</div>



<script>
let edit_id = <?php echo $update_id; ?>;

$('#back_btn').on('click',function(){
    location.href = "<?php echo base_url(); ?>";
 });  
    $(()=>{

        get_edit_data();
    })

    function get_edit_data(){
        let data = {id:edit_id};

      
        $.post('<?php echo base_url(); ?>User/get_edit_datas',data,function(res){
            let obj  = JSON.parse(res);
            
            if(obj.length > 0){
                $.each(obj, function(x,y){
                    $('#first_name').val(y.first_name);
                    $('#last_name').val(y.last_name);
                    $('#position').val(y.position);
                });
            }
          
        });
        
    }


$('#btn_save').on('click',function(){
    let first_name = $('#first_name').val();
    let last_name = $('#last_name').val();
    let position = $('#position').val();
    
 
    let data = {
        'first_name':first_name,
        'last_name':last_name,
        'position':position,
        'id':edit_id,
        
    }

    let check_data = validate_data(data);
   

    if(check_data == true){
        $.post('<?php echo base_url(); ?>User/update_data',data,function(res){
            let ret = JSON.parse(res);
          


            if(ret.ret_res){
                toastr.success('Updated Successfully!');
                window.setTimeout( function(){
                    location.href = "<?php echo base_url(); ?>";
             }, 1000 );
            }else{
                toastr.error('Error Updating Data!');
                window.setTimeout( function(){
                    location.href = "<?php echo base_url(); ?>";
             }, 1000 );
            }
        })
    }
});


function validate_data(data){

    let check_inps = true;

    if(data['first_name'] == ''){
     
        check_inps = false;
        $("#first_name").next(".validate_error_message").remove();   
        $('#first_name').css('border-color','red');
        $("<span class='validate_error_message' style='color: red;'>This is a required field.<br></span>").insertAfter($("#first_name"));

    }else{
      
        $("#first_name").css('border-color','#ccc');
	    $("#first_name").next(".validate_error_message").remove();     
    }

    if(data['last_name'] == ''){
      
       check_inps = false;
       $("#last_name").next(".validate_error_message").remove();   
        $('#last_name').css('border-color','red');
        $("<span class='validate_error_message' style='color: red;'>This is a required field.<br></span>").insertAfter($("#last_name"));

    }else{
        
        $("#last_name").css('border-color','#ccc');
	    $("#last_name").next(".validate_error_message").remove();     
    }

    if(data['position'] == ''){
   
        check_inps = false;
        $("#position").next(".validate_error_message").remove();    
        $('#position').css('border-color','red');
        $("<span class='validate_error_message' style='color: red;'>This is a required field.<br></span>").insertAfter($("#position"));

    }else{
        
        $("#position").css('border-color','#ccc');
	    $("#position").next(".validate_error_message").remove();     
    }


    return check_inps;

}


</script>
