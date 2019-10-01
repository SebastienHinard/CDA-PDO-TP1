<?php

class Users extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getUsers() {
        $this->db->join('Services', 'Users.id_Services = Services.id');
        $query = $this->db->get('Users');
        return $query->result();
    }

    public function getUserById($id) {
        $query = $this->db->get_where('Users', array('id' => $id));
        return $query->row();
    }

    public function createUser() {      
        $id=$this->input->post('id');       
        $data = array(
            'lastname' => $this->input->post('lastname'),
            'firstname' => $this->input->post('firstname'),
            'birthdate' => $this->input->post('birthdate'),
            'address' => $this->input->post('address'),
            'zipcode' => $this->input->post('zipcode'),
            'phone' => $this->input->post('phone'),
            'id_Services' => $this->input->post('id_Services'),
        );      
        if(empty($id)){
            return $this->db->insert('Users',$data);
        }else{
            $this->db->where('id',$id);
            return $this->db->update('Users',$data);
        }
    }
    public function updateUser($id) {      
        $data = array(
            'lastname' => $this->input->post('lastname'),
            'firstname' => $this->input->post('firstname'),
            'birthdate' => $this->input->post('birthdate'),
            'address' => $this->input->post('address'),
            'zipcode' => $this->input->post('zipcode'),
            'phone' => $this->input->post('phone'),
            'id_Services' => $this->input->post('id_Services'),
        );      

        $this->db->where('id',$id);
        return $this->db->update('Users',$data);
    }
    
    public function deleteUser($id){
        $this->db->where('id',$id);
        return $this->db->delete('Users');
    }

}
