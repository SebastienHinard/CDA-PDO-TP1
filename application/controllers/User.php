<?php

defined('BASEPATH') OR exist('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model('Users');
//        $this->load->model('Services');
//        $this->load->helper('url');
//        $this->load->helper('form');
        
        $this->load->model(['Users', 'Services']);
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = "Liste des utilisateurs";
        $data['services'] = $this->Services->getServices();
        $data['users'] = $this->Users->getUsers();

        $this->load->view('common/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('common/footer', $data);
    }

    public function create() {
        $data['title'] = "Ajout d'un utilisateur";
        $data['services'] = $this->Services->getServices();
        
        if ($_POST) {
            $this->form_validation->set_error_delimiters('<small class="alert alert-danger p-1 ml-1 ">', '</small>');
            
            if($this->form_validation->run() === TRUE){
                $this->Users->createUser($id);
                redirect(base_url());
            }
        } 

        $this->load->view('common/header', $data);
        $this->load->view('user/create', $data);
        $this->load->view('common/footer', $data);
    }

    public function edit($id = 0) {
        $data['title'] = "Modification d'un utilisateur";
        $data['services'] = $this->Services->getServices();
        

        if ($_POST) {
            $this->form_validation->set_error_delimiters('<small class="alert alert-danger p-1 ml-1 ">', '</small>');
                        
            if($this->form_validation->run() === TRUE){
                $this->Users->updateUser($id);
                redirect(base_url());
            }
        } 
        $data['user'] = $this->Users->getUserById($id);
        
        if (empty($data['user'])) {
            show_404();
        } else {
            $this->load->view('common/header', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('common/footer', $data);
        }
    }

    public function formCheck() {
        $id = $this->input->post('id');
        if ($this->form_validation->run() === FALSE) {
            if (empty($id)) {
                redirect(base_url('user/create'));
            } else {
                redirect(base_url('user/edit/' . $id));
            }
        } else {
            $data['user'] = $this->Users->createOrUpdate();
            redirect(base_url('user'));
        }
    }

    public function delete() {
        $id = $this->uri->segment(2);
        if (empty($id)) {
            show_404();
        } else {
            $user = $this->Users->deleteUser($id);
            redirect('');
        }
    }

}
