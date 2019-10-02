<?php

defined('BASEPATH') OR exist('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // On charge les différents model, helper et library utilise pour le TP
        $this->load->model(['Users', 'Services']);
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'pagination']);
    }

    // Méthode gérant la page d'accueil
    public function index() {
        // On passera dans le tableau data toutes les informations utiles pour la vue
        // Le titre de la page
        $data['title'] = "Liste des utilisateurs";
        // Récupération de tous les services, servant pour un l'affichage propre dans le tableau
        $data['services'] = $this->Services->getServices();
        // Récupération de tout les utilisateurs
        $data['users'] = $this->Users->getUsers();
        // On load les configurations de la pagination
        $this->load->config('pagination');
        // On load nos configurations perso pour la pagination
        $config = $this->config->item('pagination_config');
        // On calcule le nombre total d'utilisateur (changera avec la recherche)
        $config['total_rows'] = $this->Users->countAll();
        // Initilisation de la pagination avec nos options
        $this->pagination->initialize($config);
        // Récupération des liens de la pagination
        $data['pagination'] = $this->pagination->create_links();
        // Chargement des différentes vue, avec envoi du tableau data
        $this->load->view('common/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('common/footer', $data);
    }

    // Gère la page de création d'un utilisateur
    public function create() {
        // Titre de la page
        $data['title'] = "Ajout d'un utilisateur";
        // Récupération des services
        $data['services'] = $this->Services->getServices();
        // Si le formulaire de création a été submit
        if ($_POST) {
            // Modification de l'affichage des erreurs
            $this->form_validation->set_error_delimiters('<small class="alert alert-danger p-1 ml-1 ">', '</small>');
            // S'il n'y a pas d'erreurs lors de l'application des règles de vérification
            // form_validation->run() renvoi TRUE si toutes les règles ont été appliquées sans erreurs
            if ($this->form_validation->run() === TRUE) {
                // On appel la méthodes du model Users servant à la création d'un utilsilateur
                $this->Users->createUser();
                // Puis on se redirige vers la page d'accueil
                redirect(base_url());
            }
        }
        // Chargement des différentes vues servant à la création d'un utilisateur
        $this->load->view('common/header', $data);
        $this->load->view('user/create', $data);
        $this->load->view('common/footer', $data);
    }

    // Méthode gérant la modification d'un utilisateur
    public function edit($id = 0) {
        // Titre de la page
        $data['title'] = "Modification d'un utilisateur";
        // Récupération des services
        $data['services'] = $this->Services->getServices();
        // Si le formulaire de modification a été submit
        if ($_POST) {
            // Modification de l'affichage des erreurs
            $this->form_validation->set_error_delimiters('<small class="alert alert-danger p-1 ml-1 ">', '</small>');
            // S'il n'y a pas eu d'erreurs lors de l'application des règles de sécurités
            if ($this->form_validation->run() === TRUE) {
                // On appel la méthodes du model Users afin de mettre à jour l'utilisateur d'id = $id
                $this->Users->updateUser($id);
                // Puis on se redirige vers l'accueil
                redirect(base_url());
            }
        }
        // Récupération des informations de l'utilisateur choisi
        $data['user'] = $this->Users->getUserById($id);
        // Si les informations sont vides, alors l'utilisateur d'id = $id n'existe pas
        if (empty($data['user'])) {
            show_404();
        } else {
            // Affichage des vues correspondants à l'édition
            $this->load->view('common/header', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('common/footer', $data);
        }
    }

    // Méthodes gérant la suppression d'un utilisateur
    public function delete() {
        // On récupère l'id de l'utilsaiteur que l'on souhaite supprimer
        $id = $this->uri->segment(2);
        // S'il n'y a pas d'id -> page 404
        if (empty($id)) {
            show_404();
        } else {
            // On appel la méthodes du model Users afin de supprimer l'utilisateur d'id = $id
            $user = $this->Users->deleteUser($id);
            redirect('');
        }
    }

}
