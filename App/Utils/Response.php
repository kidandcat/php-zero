<?php
namespace App\Utils;


class Response {
  private $data;
  private $status;

  public function __construct($status, $data = null){
    $this->data = $data;
    $this->status = $status;
  }

  public function getData(){
    return $this->data;
  }

  public function getStatus(){
    return $this->status;
  }
}
