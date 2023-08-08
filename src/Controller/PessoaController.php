<?php
namespace App\Controller;

use App\Model\PessoaModel;

class PessoaController
{

    public function get($id = null){
            if($id && $_SERVER["REQUEST_METHOD"] === "GET"){
                return PessoaModel::SelectOne($id);
            } elseif(empty($id) && $_SERVER["REQUEST_METHOD"] === "GET") {
                return PessoaModel::SelectAll();
            } elseif ($id && $_SERVER["REQUEST_METHOD"] === "PUT"){
                var_dump($_POST);
            }
    }
    public function post(){
        return PessoaModel::Insert($_POST);
    }
    public function put($id){
        $data = json_decode(file_get_contents("php://input"));
        return PessoaModel::Edit($id, $data);
    }
    public function delete($id){

        return PessoaModel::Delete($id);
        
    }
}