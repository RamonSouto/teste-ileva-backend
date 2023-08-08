<?php
namespace App\Controller;

use App\Model\ContatoModel;

class ContatoController
{
    public function get($id = null){
        if($id && $_SERVER["REQUEST_METHOD"] === "GET"){
            return ContatoModel::SelectOne($id);
        } elseif(empty($id) && $_SERVER["REQUEST_METHOD"] === "GET") {
            return ContatoModel::SelectAll();
        } elseif ($id && $_SERVER["REQUEST_METHOD"] === "PUT"){
            var_dump($_POST);
        }
    }

    public function post($id){
        return ContatoModel::Insert($id, $_POST);
    }

    public function put($id){
        $data = json_decode(file_get_contents("php://input"));
        return ContatoModel::Edit($id, $data);
    }

    public function delete($id){
        return ContatoModel::Delete($id);
    }
}
