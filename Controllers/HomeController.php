<?php
namespace Controllers;

use \Core\Controller;
use \Models\Companies;
use \Models\Users;

class HomeController extends Controller {

	public function __construct()
	{
		$user = new Users();
		if($user->isLogged()==false){
			header("Location:".BASE_URL."login");
			exit;
		}
	}
	public function index() {
		$array = ['error'=>''];
		$user = new Users();
		$user->setLoggedUser();
		$company = new Companies($user->getCompany());
		$array['company_name'] = $company->getName();
		$array['user_email'] = $user->getEmail();
		$this->loadTemplate('home', $array);
	}

}