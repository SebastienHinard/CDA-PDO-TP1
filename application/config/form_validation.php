<?php
$config = [
    [
        'field' => 'lastname',
        'label' => 'Nom de famille',
        'rules' => 'trim|required|max_length[50]|alpha'
    ],
    [
        'field' => 'firstname',
        'label' => 'Prénom',
        'rules' => 'trim|required|max_length[50]|alpha'
    ],
    [
        'field' => 'birthdate',
        'label' => 'date de naissance',
        'rules' => ['trim','required','max_length[10]','regex_match[/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/]']
    ],
    [
        'field' => 'address',
        'label' => 'Adresse',
        'rules' => 'trim|required|max_length[100]|alpha_numeric_spaces'
    ],
    [
        'field' => 'zipcode',
        'label' => 'Code postal',
        'rules' => 'trim|required|max_length[5]|integer'
    ],
    [
        'field' => 'phone',
        'label' => 'Téléphone',
        'rules' => 'trim|required|max_length[10]|integer'
    ],
    [
        'field' => 'id_Services',
        'label' => 'Service',
        'rules' => 'trim|required|max_length[1]|integer'
    ]
];