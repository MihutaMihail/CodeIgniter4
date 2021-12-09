<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// N'oubliez pas d'ajouter la référence au namespace sinon la classes TaskModel ne sera pas utilisable
// dans le source
use App\Models\TaskModel;
use App\Entities\Task;

class TaskController extends BaseController
{
	    public function __construct() {
		// On place dans le constructeur toutes les classes nécessaires lors de l'aappel des différentes
		// méthodes. Attention au double underscore de construct(). Les helpers sont des bibliothèques de
		// classes det de fonctions que l'on va utiliser lors du développement. On les charges dans le constructeur
		$this->helpers = ['form','url'];
		// On rajoute le modèle en tant que donnée membre du Controleur ainsie on pourra ...
		$this->taskModel = new TaskModel();
	}

    public function index() {
       // On instancie un nouveau Model
	   $taskModel = new TaskModel();
	   // Le modèle contient déjà toutes les méthodes d'accès aux données. Chaque méthode d'accèes au données
	   // à le nom d'une primite SQL : where, whereIn, innerJoin, on, orderBy,etc
	   // La méthode findAll exécute la requête et renvoie le résultat
	   $tasks = $taskModel->orderBy('id')->findAll();
	   // On place le résultat dans le tableau $data
	   $data['tasks'] = $tasks;
	   $data['titre'] = "au boulot";
	   // On génère la vue
	   return view('Task-index.php',$data);
	}

	// Il va falloir prévoir un nouveau formulaire permettant de créer une nouvelle tâche
	public function create() {
		$data['titre'] = 'Nouvelle Tâche';
		return view('Task-form.php',$data);
	}

	// La méthode prévoir de reçevoir l'id de la tâche à supprimer
	public function delete(int $id) {
		$this->taskModel->where(['id'=> $id])->delete();
		return redirect()->to('/')->with('message','Tâche supprimée');
	}

	// La méthode prévoir de reçevoir l'id mais par défaut elle ne reçevra aucun paramère
	// c'est le seul moyen de créer une surcharge en php
	public function save(int $id = null) {
		// Définir les règles de validation du formulaire
		// Que l'on récupère de Taskmodel
		$rules = $this->taskModel->getValidationRules();
		// On vérifie que l'on passe la validation
		if (!$this->validate($rules)) {
			// en cas d'erreur on redirige vers la page précédente
			return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
		} else {
			// En cas de succès de la validation
			// On récupère les donnes du formulaire
			$form_data = [
				'text' => $this->request->getPost('text'),
			];
			// Créer une instance de notre tâche
			$task = new Task($form_data);
			// Génère insert/update
			$this->taskModel->save($task);
			return redirect()->to('/')->with('message','Tâche sauvegardée');
		}
	}
}
