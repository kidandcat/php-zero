<?php

namespace App\Models;

use App\Models\DB;


class Menu {
  private $db;

  public function __construct(){
    $this->db = new DB();
  }

  public function create($name, $link){
    $res = $this->db->query('INSERT INTO menu SET name = ?, link = ?', [
      $name,
      $link
    ]);
  }

  public function getAll(){
    return $this->db->query('SELECT * FROM menu');
  }

  public function getOneByName($name){
    return $this->getOneBy('name', $name);
  }

  public function getOneByLink($link){
    return $this->getOneBy('link', $link);
  }

  private function getOneBy($param, $value){
    return $this->db->queryOne('SELECT * FROM menu WHERE ? = ?', [
      $param,
      $value
    ]);
  }
}
