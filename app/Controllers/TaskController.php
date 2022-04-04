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
	   $tasks = $this->taskModel->orderBy('order')->paginate();
	   $data['tasks'] = $tasks;
	   $data['titre'] = "Au boulout";
	   $data['pager'] = $this->taskModel->pager;
	   return view('Task-index.php',$data);
	}

	public function indexUser(int $userId) {
		$tasks = $this->taskModel->where(['user_id' => $userId])->orderBy('order')->paginate();
		$data['tasks'] = $tasks;
		$data['titre'] = "Au boulout";
		$data['pager'] = $this->taskModel->pager;
		return view('Task-index.php',$data);
	 }

	public function create() {
		$data['titre'] = 'Nouvelle Tâche';
		return view('Task-form.php',$data);
	}

	public function delete(int $id) {
		$this->taskModel->where(['id'=> $id])->delete();
		return redirect()->to('/')->with('message','Tâche supprimée');
	}

	// La méthode prévoir de reçevoir l'id mais par défaut elle ne reçevra aucun paramère
	// c'est le seul moyen de créer une surcharge en php
	public function save(int $id = null) {
		$rules = $this->taskModel->getValidationRules();
		if (!$this->validate($rules)) {
			// en cas d'erreur on redirige vers la page précédente
			return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
		} else {
			// En cas de succès de la validation
			// On récupère les donnes du formulaire
			$form_data = [
				'text' => $this->request->getPost('text'),
				'order' => $this->request->getPost('order'),
				'user_id' => $this->request->getPost('user_id'),
			];
			//Si l'id n'est pas null on l'ajoute dans les données à transmettre
			if (!is_null($id)){
				$form_data['id'] = $id;
			}
			// Créer une instance de notre tâche
			$task = new Task($form_data);
			// Génère insert/update
			$this->taskModel->save($task);
			return redirect()->to('/')->with('message','Tâche sauvegardée');
		}
	}

	public function edit(int $id){
		$data['titre'] = "Modifier tâche";
		$data['task'] = $this->taskModel->find($id);
		return view('Task-form.php',$data);
	}

	public function done(int $id){
		$this->taskModel->update($id,['done' => '1']);
		return redirect()->to('/')->with('message','Tâche faite');
	}

	public function indexReorder(){
		$tasks = $this->taskModel->orderBy('order')->findAll();
		$index = 10;
		// on renumérote l'ordre de toutes les tâches
		foreach($tasks as $task){
			$task->order=$index;
			$index+=10;
		}
		$data['tasks'] = $tasks;
		$data['titre'] = "Réordonner les tâches";
		return view('Reorder-index.php', $data);
	}

	public function saveReorder(){
		$validation = \Config\Services::validation();
		$validation->setRule('order.*','ordre','required|numeric');
		if (!$validation->withRequest($this->request)->run()){
			return redirect()->back()->withInput()->with('errors',$validation->getErrors());
		} else {
			$orders = $this->request->getPost('order[]');
			$ids = $this->request->getPost('id[]');
			$index = 0;
			foreach($ids as $id){
				$form_data = [
					'order' => $orders[$index],
					'id' 	=> $ids[$index],
				];
				$task = new Task($form_data);
				$this->taskModel->save($task);
				$index++;
			}
			return redirect()->to('/')->with('message', "Tâches réorganisées");
		}
	}
}


