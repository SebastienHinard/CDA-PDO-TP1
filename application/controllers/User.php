<?php

defined('BASEPATH') OR exist('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Users', 'Services']);
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'pagination', 'session']);
        $this->load->config('pagination');
    }

    public function index($rowno=0) {
        $data['title'] = "Liste des utilisateurs";
        $data['services'] = $this->Services->getServices();

        // Search text
        $search_text = "";
        if ($this->input->post('field') != NULL) {
            $search_text = $this->input->post('field');
            $this->session->set_userdata(array("search" => $search_text));
        } else {
            if ($this->session->userdata('search') != NULL) {
                $search_text = $this->session->userdata('search');
            }
        }

        // Row per page
        $rowperpage = 3;

        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        // All records count
        $allcount = $this->Users->getrecordCount($search_text);

        // Get records
        $users_record = $this->Users->getData($rowno, $rowperpage, $search_text);

        // Pagination Configuration
        $config['base_url'] = site_url('page');
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();
        $data['users'] = $users_record;
        $data['row'] = $rowno;
        $data['search'] = $search_text;


//        // init params
//        $limit_per_page = 3;
//        $start_index = ($this->uri->segment(2)) ? ($this->uri->segment(2) - 1) * $limit_per_page : 0;
//        $total_records = $this->Users->get_total();
//
//        if ($total_records > 0) {
//            // get current page records
//            $data['users'] = $this->Users->get_current_page_records($limit_per_page, $start_index);
//
//            $config = $this->config->item('pagination_config');
//            $config['base_url'] = site_url('page');
//            $config['total_rows'] = $total_records;
//            $config['uri_segment'] = 2;
//
//            $this->pagination->initialize($config);
//
//            // build paging links
//            $data['links'] = $this->pagination->create_links();
//        }
//        if (isset($_POST['field']) && $_POST['field']!=0) {
//            $data['users'] = $this->Users->getUsersByServices($_POST['field']);
//        } else {
//            $data['users'] = $this->Users->getUsers();
//        }

        $this->load->view('common/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('common/footer', $data);
    }

    public function create() {
        $data['title'] = "Ajout d'un utilisateur";
        $data['services'] = $this->Services->getServices();

        if ($_POST) {
            $this->form_validation->set_error_delimiters('<small class="alert alert-danger p-1 ml-1 ">', '</small>');

            if ($this->form_validation->run() === TRUE) {
                $this->Users->createUser();
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

            if ($this->form_validation->run() === TRUE) {
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
