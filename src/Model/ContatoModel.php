<?php
namespace App\Model;

use App\Config\Connection;
use Exception;

class ContatoModel
{
    private static $table = 'Contato';

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

    public static function Insert($id, $data){
        $sql = 'INSERT INTO ' . self::$table . ' (id_pessoa,tipo,contato) values(:id,:tipo,:contato)';
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':tipo', $data['tipo']);
        $stmt->bindValue(':contato', $data['contato']);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return 'Contato cadastrado com sucesso!';
        } else {
            return new Exception("Falha ao inserir cadastro de Contato");
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

            return 'Contato excluido com sucesso!';
        } else {
            return new Exception("Falha ao excluir cadastro de Contato");
        }
    }

    public static function Edit($id, $data){
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        
        if($stmt->rowCount() > 0) {
            $sql = "UPDATE " . self::$table . " SET tipo = :tipo, contato = :contato WHERE id = :id";
            $stmt = Connection::connect()->prepare($sql);
            $stmt->bindValue(':tipo', $data->tipo);
            $stmt->bindValue(':contato', $data->contato);
            $stmt->bindValue(':id', $id);
            
            if($stmt->execute()){
                return 'Contato editado com sucesso!';
            }
        } else {
            return new Exception("Falha ao editar cadastro de Contato");
        }
    }
}