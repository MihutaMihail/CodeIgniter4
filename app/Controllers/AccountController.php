<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use Myth\Auth\Models\UserModel;

class AccountController extends BaseController
{
    public function __construct(){
        $this->userModel = new UserModel();
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
}
