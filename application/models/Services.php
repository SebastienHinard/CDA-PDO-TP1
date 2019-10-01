<?php

class Services extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getServices() {
        $query = $this->db->get('Services');
        return $query->result();
    }
    
    public function getServiceById($id) {
        $query = $this->db->get_where('Services', array('id' => $id));
        return $query->row();
    }
}

