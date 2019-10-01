<?php

defined('BASEPATH') OR exist('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Users');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = "Liste des utilisateurs";
        $data['users'] = $this->Users->getUsers();

        $this->load->view('common/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('common/footer', $data);
    }

    public function create() {
        $data['title'] = "Ajout d'un utilisateur";

        $this->load->view('common/header', $data);
        $this->load->view('user/create', $data);
        $this->load->view('common/footer', $data);
    }

    public function edit() {
        $id = $this->uri->segment(2);
        $data['title'] = "Modification d'un utilisateur";

        if (empty($id)) {
            show_404();
        } else {
            $data['user'] = $this->Users->getUserById($id);
            
            $this->load->view('common/header', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('common/footer', $data);
        }
    }
    
    public function formCheck(){
//        $this->form_validation->set_rules('title', 'Title', 'required');
//        $this->form_validation->set_rules('description', 'Description', 'required');
        $id = $this->input->post('id');
        if ($this->form_validation->run() === FALSE){  
            if(empty($id)){
                redirect( base_url('user/create') ); 
            }else{
                redirect( base_url('user/edit/'.$id) ); 
            }
        }else{
            $data['user'] = $this->Users->createOrUpdate();
            redirect( base_url('user') ); 
        } 
    }
     
    public function delete(){
        $id = $this->uri->segment(2);
        if (empty($id)){
            show_404();
        }else{
            $user = $this->Users->deleteUser($id);
            redirect( base_url('user') );   
        }
    }

}
