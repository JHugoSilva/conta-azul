<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;

class LoginController extends Controller {

	public function index() {
		$array = [];

		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = addslashes($_POST['email']);
			$pass = addslashes($_POST['password']);
			
			$user = new Users();
			
			if ($user->doLogin($email, $pass)) {
				header("Location:".BASE_URL);
				exit;
			} else {
				$array['error'] = 'E-mail e/ou senha errados.';
			}
		}
		$this->loadView('login', $array);
	}

	public function logout() {
		$user = new Users();
		$user->logout();
		header("Location:".BASE_URL);
	}

}