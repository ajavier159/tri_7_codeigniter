<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

   
	public function index()
	{
        $data['title'] = 'User';
        $data['content'] = 'user/page';
		$this->load->view('layout/header',$data);
	}

    public function get_page_data(){
       
        $res = $this->User_model->get_list();
      
  
        $data = array();
        $count = 1;
        foreach($res as $row){
            
            $row['action'] = '<input type="button" class="btn btn-warning" id="btn_edit" onclick="edit_btn('.$row["id"].')" value="Edit"><input type="button" class="btn btn-danger mx-2" id="delete_btn" onclick="delete_btn('.$row["id"].')" value="Delete">';
            $row['id'] = $count++;
            array_push($data,$row);
        }
       
        echo json_encode($data);

    }

    public function add_page()
	{
        $data['title'] = 'Add User';
        $data['content'] = 'user/add';
		$this->load->view('layout/header',$data);
	}

    public function add_data(){
        $data = $this->input->post();
       
        $res = $this->User_model->add_data($data);
        echo json_encode(array('ret_res'=>$res));
    }

    public function edit_page($id)
	{
      
        $data['title'] = 'Edit User';
        $data['content'] = 'user/edit';
        $data['update_id'] = $id;
		$this->load->view('layout/header',$data);
	}

    public function get_edit_datas(){
      $id = $this->input->post('id');
      $res = $this->User_model->get_list($id);
      echo json_encode($res);
        
    }

    public function update_data(){
        $data = $this->input->post();
       
        $res = $this->User_model->update_data($data);
        echo json_encode(array('ret_res'=>$res));
    }

    public function delete_data(){
        $data = $this->input->post();
        
       
        $res = $this->User_model->delete_data($data);
        echo json_encode(array('ret_res'=>$res));
    }

    
}
