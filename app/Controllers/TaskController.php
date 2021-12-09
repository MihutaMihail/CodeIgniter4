<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TaskController extends BaseController
{
    public function index()
    {
        $data['tasks']=$this->create_jeu_essai();
	$data['titre']="au boulot";
	return view('Task-index.php',$data);
    }

    private function create_jeu_essai() {
	return [
		(object)['text'=>"pipi",'id'=>1],
		(object)['text'=>"les dents",'id'=>2],
		(object)['text'=>"au dodo",'id'=>3],
	];
   }
}
