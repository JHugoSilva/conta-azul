<?php

namespace Models;

use Core\Model;
use PDOException;

class Permissions extends Model{
    
    private $group;
    private $permissions;

    public function setGroup($id, $id_company){
        $this->group = $id;
        $this->permissions = [];
        $sql="SELECT params FROM permission_groups
        WHERE id = :id AND id_companies=:id_company
        ";
        $sql=$this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();

            if(empty($row['params'])){
                $row['params'] = '0';
            }
            $params = $row['params'];
            $sql="SELECT name FROM permission_params WHERE id IN({$params})
            AND id_companies=:id_company";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':id_company', $id_company);
            $sql->execute();
            if($sql->rowCount() > 0){
                foreach ($sql->fetchAll() as $item) {
                    $this->permissions[] = $item['name'];
                }
            }
        }
    }

    public function hasPermission($name)
    {
        if (in_array($name, $this->permissions)) {
            return true;
        } else {
            return false;
        }
    }

    public function getList($id_company)
    {
        $list = [];
        try {
            $sql="SELECT * FROM permission_params 
            WHERE id_companies=:id_company";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':id_company', $id_company);
            $sql->execute();
            if($sql->rowCount() > 0){
                $list = $sql->fetchAll();
            }
            return $list;
        } catch (\PDOException $error) {
            echo "ERROR GET LIST:".$error->getMessage();
        }
    }

    public function add($name, $id_company)
    {
        try {
            $sql="INSERT INTO permission_params (name, id_companies)
            VALUES(:name, :id_companies)";
            $sql=$this->db->prepare($sql);
            $sql->bindValue(':name', $name);
            $sql->bindValue(':id_companies', $id_company);
            $sql->execute();
        } catch (\PDOException $error) {
            echo "ERROR PERMISSIONS ADD:".$error->getMessage();
        }
    }

}