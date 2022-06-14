

<div class="container py-4">
    <div class="row">
        <div class="col-md-2 offset-md-10 py-4">
            <button type="button" class="btn btn-success" id="add_user">Add User</button>
        </div>
        <div class="col-md-12">
            <table class="table table-hover" id="user_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="modal_delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="btn_delete">Yes, Delete.</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

$(()=>{
    
    get_page();
});

// ADD DATA
 $('#add_user').on('click',function(){
    location.href = 'User/add_page';
 });

// GET LIST 
function get_page(){
  
    $('#user_table').DataTable({
        processing: false,
        serverSide: false,
        bDestroy:true,
        searching: true,
        ajax: {
            url: 'User/get_page_data',
            type: 'POST',
            dataSrc: '',
        },
        
        columns: [
            { data: 'id' },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'position' },
            { data: 'create_date' },
            { data: 'action' }
        ],

    });

}

//EDIT DATA
const edit_btn = (id) => {
  
    location.href = 'User/edit_page/'+id;
}

// DELETE DATA
let delete_id;
const delete_btn = (id) => {

    delete_id = id;
    $('#modal_delete').modal('show');
    
}

$('#btn_delete').on('click',function(){

    $('#modal_delete').modal('hide');
    let data = {'id':delete_id}
    $.post('<?php echo base_url(); ?>User/delete_data',data,function(res){
        let ret = JSON.parse(res);
        if(ret.ret_res){
                toastr.success('Deleted Successfully!');
                get_page();
            }else{
                toastr.error('Error Deleting Data!');
                get_page();
            }
    });
})


</script>
