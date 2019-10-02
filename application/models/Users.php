<?php

class Users extends CI_Model {

    public function __construct() {
        // Chargement de la base de donnée conformément au fichier config/database.php
        $this->load->database();
    }

    // Méthode servant à calculer le nombre d'utilisateur
    public function countAll() {
        // Si $_GET['service'] existe s'est que l'on a souhaité filtrer les utilisateurs
        if (isset($_GET['service']) && $_GET['service'] != 0) {
            // Filtrage en fonction de l'id du service
            $this->db->where('id_Services', $_GET['service']);
            $this->db->from('Users');
            // Renvoi le nombre de ligne trouvé
            return $this->db->count_all_results();
        }
        // Sinon on renvoi le nombre total d'utilisateur de la table Users
        return $this->db->count_all('Users');
    }

    // Méthode récupérant les utilsateurs que l'on souhaite afficher
    public function getUsers() {
        // Nombre de ligne par page
        $results = 5;
        // Définition du point de départ en fonction du numéro de la page et du 'pas'
        $first = isset($_GET['per_page']) ? ($_GET['per_page'] - 1) * $results : 0;
        $this->db->select(['Users.*', 'Services.name']);
        // Jointure en la table Users et Services
        $this->db->join('Services', 'Users.id_Services = Services.id');
        // limit(nombre de ligne, point de départ)
        $this->db->limit($results, $first);
        // Si on utlise le filtrage par service
        if (isset($_GET['service']) && $_GET['service'] != 0) {
            // On récupère les utilisateurs en fonction du filtre
            $query = $this->db->get_where('Users', array('id_Services' => $_GET['service']));
            // Sinon
        } else {
            // On récupère tout les utilisateurs
            $query = $this->db->get('Users');
        }
        return $query->result();
    }

    // Méthode pour récupérer les info d'un utilisateur
    public function getUserById($id) {
        $query = $this->db->get_where('Users', array('id' => $id));
        return $query->row();
    }

    // Création d'un utilisateur
    public function createUser() {
        // On récupère les informations du formulaire
        $data = array(
            'lastname' => $this->input->post('lastname'),
            'firstname' => $this->input->post('firstname'),
            'birthdate' => $this->input->post('birthdate'),
            'address' => $this->input->post('address'),
            'zipcode' => $this->input->post('zipcode'),
            'phone' => $this->input->post('phone'),
            'id_Services' => $this->input->post('id_Services'),
        );
        // Puis on insert ces informations dans la table Users
        return $this->db->insert('Users', $data);
    }
    // Mise à jour d'un utilisateur
    public function updateUser($id) {
        // On récupère les informations du formulaire
        $data = array(
            'lastname' => $this->input->post('lastname'),
            'firstname' => $this->input->post('firstname'),
            'birthdate' => $this->input->post('birthdate'),
            'address' => $this->input->post('address'),
            'zipcode' => $this->input->post('zipcode'),
            'phone' => $this->input->post('phone'),
            'id_Services' => $this->input->post('id_Services'),
        );
        // Puis on insert les nouvelles informations de l'utilisateur dans la table Users
        $this->db->where('id', $id);
        return $this->db->update('Users', $data);
    }
    // Suppression d'un utilsiateur
    public function deleteUser($id) {
        $this->db->where('id', $id);
        return $this->db->delete('Users');
    }

}
