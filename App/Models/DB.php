<?php
namespace App\Models;

use App\Utils\ResultsetParser;

class DB {
  private static $connection;

  function __construct(){
    if(!isset(self::$connection)){
      $configs = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/App/Config/db.ini');
      $dbname = $configs['dbname'];
      $host = $configs['host'];
      self::$connection = new \PDO("mysql:host=$host;dbname=$dbname",$configs['username'],$configs['password']);
    }
  }

  public function query(String $sql, Array $parameters = []){
    $sth = self::$connection->prepare($sql);
    // foreach ($parameters as $key => $value) {
    //   $k = $key+1;
    //   $sth->bindParam($k,$value);
    // }
    $sth->execute($parameters);
    return ResultsetParser::Parse($sth->fetchAll());
  }

  public function queryOne(String $sql, Array $parameters){
    return $this->query($sql, $parameters)[0];
  }
}
