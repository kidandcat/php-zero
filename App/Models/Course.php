<?php

namespace App\Models;

use App\Models\DB;

class Course {
  private $db;

  public function __construct(){
    $this->db = new DB();
  }

  public function create($title, $description, $image){
    return $this->db->query('INSERT INTO course SET title = ?, description = ?, image = ?', [
      $title,
      $description,
      $image
    ]);
  }

  public function getAll(){
    return $this->db->query('SELECT * FROM course');
  }

  public function getOneByTitle($name){
    return $this->getOneBy('title', $name);
  }

  public function getOneByDescription($link){
    return $this->getOneBy('description', $link);
  }

  public function getOneByImage($image){
    return $this->getOneBy('image', $image);
  }

  private function getOneBy($param, $value){
    return $this->db->queryOne('SELECT * FROM course WHERE ? = ?', [
      $param,
      $value
    ]);
  }
}
