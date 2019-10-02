<?php

class Users extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getUsers() {
        $this->db->select(['Users.*', 'Services.name']);
        $this->db->order_by('id', 'ASC');
        $this->db->join('Services', 'Users.id_Services = Services.id');
        $query = $this->db->get('Users');
        return $query->result();
    }

    public function getUserById($id) {
        $query = $this->db->get_where('Users', array('id' => $id));
        return $query->row();
    }

    public function getUsersByServices($id) {
        $this->db->join('Services', 'Users.id_Services = Services.id');
        $query = $this->db->get_where('Users', array('id_Services' => $id));
        return $query->result();
    }

    public function createUser() {
        $id = $this->input->post('id');
        $data = array(
            'lastname' => $this->input->post('lastname'),
            'firstname' => $this->input->post('firstname'),
            'birthdate' => $this->input->post('birthdate'),
            'address' => $this->input->post('address'),
            'zipcode' => $this->input->post('zipcode'),
            'phone' => $this->input->post('phone'),
            'id_Services' => $this->input->post('id_Services'),
        );
        if (empty($id)) {
            return $this->db->insert('Users', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('Users', $data);
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

        $this->db->where('id', $id);
        return $this->db->update('Users', $data);
    }

    public function deleteUser($id) {
        $this->db->where('id', $id);
        return $this->db->delete('Users');
    }

    public function get_total() {
        return $this->db->count_all('Users');
    }

    public function get_current_page_records($limit, $start) {

        $this->db->select(['Users.*', 'Services.name']);
        $this->db->order_by('id', 'ASC');
        $this->db->join('Services', 'Users.id_Services = Services.id');
        $this->db->limit($limit, $start);
        $query = $this->db->get('Users');

        return $query->result();
    }

    // Fetch records
  public function getData($rowno,$rowperpage,$search="") {
 
    $this->db->select('*');
    $this->db->from('Users');

    if($search != ''){
      $this->db->like('id_Services', $search);
    }

    $this->db->limit($rowperpage, $rowno); 
    $query = $this->db->get();
 
    return $query->result();
  }

  // Select total records
  public function getrecordCount($search = '') {

    $this->db->select('count(*) as allcount');
    $this->db->from('Users');
 
    if($search != ''){
      $this->db->like('id_Services', $search);
    }

    $query = $this->db->get();
    $result = $query->result_array();
 
    return $result[0]['allcount'];
  }

}
