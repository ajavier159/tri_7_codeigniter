<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Singapore');

	class User_model extends CI_Model{ 

        public function get_list($id=null){
            $this->db->select("id,first_name,last_name,position,create_date");
            
            if($id != null){
                $this->db->where('id',$id);
            }
            $this->db->from("user");
            
            $result = $this->db->get();

            return $result->result_array();
        }
        
        public function add_data($data){
            $data['create_date'] = date('Y-m-d');

            $res = $this->db->insert('user',$data);
            return $res;
        }

        public function update_data($data){
            $id = $data['id'];
            unset($data['id']);

            $this->db->where('id',$id);
            $this->db->update('user',$data);
            $res = $this->db->affected_rows();
            ($res == 1)? $res = true : $res = false;
            return $res;
        }

        
        public function delete_data($data){
            $id = $data['id'];
       

            $this->db->where('id',$id);
            $this->db->delete('user');
            $res = $this->db->affected_rows();
            ($res == 1)? $res = true : $res = false;
            return $res;
        }

    }