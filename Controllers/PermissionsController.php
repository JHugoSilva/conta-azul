<?php
namespace Controllers;

use Core\Controller;
use Models\Companies;
use Models\Permissions;
use Models\Users;

class PermissionsController extends Controller{

    public function __construct()
    {
        $user = new Users();
        if($user->isLogged() == false){
            header("Location:".BASE_URL."login");
            exit;
        }
    }

    public function index()
    {
        $array = [];
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $array['company_name'] = $company->getName();
        $array['user_email'] = $user->getEmail();

        if ($user->hasPermission('permission_view')) {
            $permissions = new Permissions();
            $array['permissions_list'] = $permissions->getList($user->getCompany());
            $this->loadTemplate('permissions', $array);
        } else {
            header("Location:".BASE_URL);
            exit;
        }
    }

    public function add()
    {
        $array = [];
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $array['company_name'] = $company->getName();
        $array['user_email'] = $user->getEmail();

        if ($user->hasPermission('permission_view')) {
            $permissions = new Permissions();
            
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $name = addslashes($_POST['name']);
                $permissions->add($name, $user->getCompany());
                header("Location:".BASE_URL."/permissions");
                exit;
            }
            $this->loadTemplate('permissions_add', $array);
        } else {
            header("Location:".BASE_URL);
            exit;
        }
    }
}