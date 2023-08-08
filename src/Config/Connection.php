<?php

namespace App\Config;

use Exception;
use PDO;

class Connection
{
  static function connect()
  {
    try {
      $host = $_ENV['DB_HOST'];
      $db = $_ENV['DB_DATABASE'];
      $user = $_ENV['DB_USERNAME'];
      $password = $_ENV['DB_PASSWORD'];

      return new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $password);
    } catch (Exception $e) {
      return die('Houve algum erro no banco de dados');
    }
  }
}