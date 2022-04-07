<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// N'oubliez pas d'ajouter la référence au namespace sinon la classes TaskModel ne sera pas utilisable
// dans le source
use App\Models\TaskModel;
use App\Entities\Task;
use Myth\Auth\Models\UserModel;

class TaskController extends BaseController
{
	public function __construct() {
		// On place dans le constructeur toutes les classes nécessaires lors de l'aappel des différentes
		// méthodes. Attention au double underscore de construct(). Les helpers sont des bibliothèques de
		// classes det de fonctions que l'on va utiliser lors du développement. On les charges dans le constructeur
		$this->helpers = ['form','url'];
		// On rajoute le modèle en tant que donnée membre du Controleur ainsie on pourra ...
		$this->taskModel = new TaskModel();
		$this->userModel = new UserModel();
	}

    public function indexVisiteur() {
	   $data['titre'] = "Accueil";
	   return view('Accueil-index.php',$data);
	}

	public function indexUser(int $userId) {
		if (user()->id == $userId) {
			$tasks = $this->taskModel->where(['user_id' => $userId])->orderBy('order')->paginate();
			$data['tasks'] = $tasks;
			$data['titre'] = "Au boulout";
			$data['pager'] = $this->taskModel->pager;
			return view('Task-index.php',$data);
		} else {
			return redirect()->back()->with('error','Vous n\'avez pas accès aux tâches des autres utilisateurs.');
		}
	 }

	public function create() {
		$data['titre'] = 'Nouvelle Tâche';
		$data['message'] = "Nouvelle tâche ajoutée";
		return view('Task-form.php',$data);
	}

	public function delete(int $id) {
		$this->taskModel->where(['id'=> $id])->delete();
		return redirect()->to('/taches/' . user()->id)->with('message','Tâche supprimée');
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
			return redirect()->to('/taches/' . user()->id)->with('message','Tâche sauvegardée');
		}
	}
	
	public function modificationMail(){
		$rules = [
			'email' => 'required|valid_email',
		];
		if (!$this->validate($rules)){
			return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
		} else {
			$newEmail = $this->request->getPost('email');
			$id = user()->id;
			$this->userModel->update($id,['email' => $newEmail]);
			return redirect()->to('/account')->with('message',"E-mail modifiée");
		}
	}

	public function modificationUsername(){
		$rules = [
			'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]',
		];
		if (!$this->validate($rules)){
			return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
		} else {
			$newUsername = $this->request->getPost('username');
			$id = user()->id;
			$this->userModel->update($id,['username' => $newUsername]);
			return redirect()->to('/account')->with('message',"Nom d'utilisateur modifiée");
		}
	}

	public function modificationPassword(){
		$rules = [
			'password'	 => 'required|strong_password',
			'pass_confirm' => 'required|matches[password]',
		];
		if (!$this->validate($rules)){
			return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
		} else {
			$newPassword = $this->request->getPost('password');
			$passwordHash = \Myth\Auth\Password::hash($newPassword);
			$id = user()->id;
			$this->userModel->update($id,['password_hash' => $passwordHash]);
			return redirect()->to('/account')->with('message',"Mot de passe modifiée");
		}
	}

	public function edit(int $id){
		$data['titre'] = "Modifier tâche";
		$data['message'] = "Tâche modifiée";
		$data['task'] = $this->taskModel->find($id);
		return view('Task-form.php',$data);
	}

	public function editAccount(){
		$data['titre'] = "Modifier vos identifiants";
		return view('account.php',$data);
	}

	public function done(int $id){
		$this->taskModel->update($id,['done' => '1']);
		return redirect()->to('/taches/' . user()->id)->with('message','Tâche faite');
	}

	public function indexReorder(int $userId){
		$tasks = $this->taskModel->where(['user_id' => $userId])->orderBy('order')->findAll();
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
			return redirect()->to('/taches/' . user()->id)->with('message', "Tâches réorganisées");
		}
	}
}


