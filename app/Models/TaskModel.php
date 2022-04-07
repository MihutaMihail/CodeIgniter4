<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $DBGroup          = 'default';

    // La table mySql lié au Model
    protected $table            = 'task';

    // Permet à codeigniter de connaiter l'attribut identifiant pour ainsi
    // Générer automitquement ses reqûetes 'insert', 'update' et 'delete'
    protected $primaryKey       = 'id';

    // C'est une clé autoincrémenté ci4 doit le savoir
    protected $useAutoIncrement = true;

    // Point de départ de l'autoincrémentation
    protected $insertID         = 0;

    // Permet de manipuler des objets au lieu de tableau
    protected $returnType       = 'object';

    // Les 'delete' sont gérés par des suppréssions logiques et non physiques
    // Utile dans certaines situations où l'on doit conserver même les données supprimmées
    protected $useSoftDeletes   = false;

    // Lié à allowedFields
    protected $protectFields    = true;

    // Indispensable sans préciser quels sont les champs autorisés vous ne pourrez pas mettre à jour
    // la base de données, id qui est autoincrémenté n'est pas concerné car il est géré directement par 
    // la base de donnée et non votre programme
    protected $allowedFields    = ['text','done','order','user_id'];

    // Dates
    // Pas utilisés ici mais permet de générer et de gérér automatiquement pour chaque occurence de la base
    // de données une date de création et de modification
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    // Important permet de définir des règles simples de validation des données pour la saisie utilisateur
    // : voir la liste des mots clés : https://codeigniter.com/user_guide/libraries/validation.html
    protected $validationRules      = [
        'text' => 'required|string|max_length[100]',
        'order' => 'required|numeric',
    ];

    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    // Les Callbacks ne sont pas utilisés ici mais intéressant
    // Ce soint des points d'entrée pour placer des méthodes qui serond automatiquement appelées lorsque
    // l'événement sur le modèle se produit.
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}

