<?php
defined('BASEPATH') OR exist ('No direct script access allowed');


class User extends CI_Controller {

    public function index(){
        $data['title'] = "Liste des utilisateurs";
        
        $this->load->view('common/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('common/footer', $data);
    }
    
}
