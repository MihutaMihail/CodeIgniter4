<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// N'oubliez pas d'ajouter la référence au namespace sinon la classes TaskModel ne sera pas utilisable
// dans le source
use App\Models\TaskModel;

class TaskController extends BaseController
{
    public function index()
    {
       // On instancie un nouveau Model
	   $taskModel = new Taskmodel();
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
}
