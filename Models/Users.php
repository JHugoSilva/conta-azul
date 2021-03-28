<?php
namespace Models;

use \Core\Model;

class Users extends Model {

	private $userInfo;
	private $permissions;

	public function isLogged(){
		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
			return true;
		} else {
			return false;
		}
	}

	public function doLogin($email, $pass)
	{
		$row = [];
		$sql="SELECT * FROM users WHERE email=:email";
		$sql=$this->db->prepare($sql);
		$sql->bindValue(':email',$email);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$hashPass = password_verify($pass, $row['password']);
			if($hashPass){
				$_SESSION['ccUser'] = $row['id'];
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function setLoggedUser() {
		if(isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])){
			$id = $_SESSION['ccUser'];
			$sql="SELECT * FROM users WHERE id=:id";
			$sql=$this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
			if($sql->rowCount() > 0){
				$this->userInfo = $sql->fetch();
				$this->permissions = new Permissions();
				$this->permissions->setGroup($this->userInfo['group_user'], $this->userInfo['id_companies']);
			}
		}
	}

	public function getCompany() {
		if (isset($this->userInfo['id_companies'])) {
			return $this->userInfo['id_companies'];
		} else {
			return 0;
		}
	}

	public function getEmail() {
		if (isset($this->userInfo['email'])) {
			return $this->userInfo['email'];
		} else {
			return 0;
		}
	}

	public function logout(){
		unset($_SESSION['ccUser']);
	}
	
	public function hasPermission($name) {
		return $this->permissions->hasPermission($name);
	}

}