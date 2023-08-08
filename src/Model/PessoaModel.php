<?php
namespace App\Model;

use App\Config\Connection;
use Exception;

class PessoaModel
{
    private static $table = 'Pessoa';

    public static function SelectAll(){
        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return new Exception("Nenhum registro encontrado");
        }
    }
    public static function SelectOne(int $id){
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return new Exception("Nenhum registro encontrado");
        }
    }

    public static function Insert($data){
        $sql = 'INSERT INTO ' . self::$table . ' (Nome,Sexo) values(:Nome,:Sexo)';
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(':Nome', $data['Nome']);
        $stmt->bindValue(':Sexo', $data['Sexo']);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return 'Pessoa cadastrado com sucesso!';
        } else {
            return new Exception("Falha ao inserir cadastro de Pessoa");
        }
    }

    public static function Delete(int $id){
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        
        if($stmt->rowCount() > 0) {
            $sql = 'DELETE FROM ' . self::$table . ' WHERE id = :id';
            $stmt = Connection::connect()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return 'Pessoa excluido com sucesso!';
        } else {
            return new Exception("Falha ao excluir cadastro de Pessoa");
        }
    }

    public static function Edit($id, $data){
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        
        if($stmt->rowCount() > 0) {
            $sql = "UPDATE " . self::$table . " SET nome = :nome, sexo = :sexo WHERE id = :id";
            $stmt = Connection::connect()->prepare($sql);
            $stmt->bindValue(':nome', $data->nome);
            $stmt->bindValue(':sexo', $data->sexo);
            $stmt->bindValue(':id', $id);
            
            if($stmt->execute()){
                return 'Pessoa editado com sucesso!';
            }
        } else {
            return new Exception("Falha ao editar cadastro de Pessoa");
        }

    }
}
