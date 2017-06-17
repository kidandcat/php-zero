<?php
namespace App\Utils;


class ResultsetParser {
  public static function Parse(Array $res){
    $result = [];
    foreach ($res as $r) {
      $rr = [];
      foreach ($r as $key => $value) {
        if(gettype($key) == 'string'){
          $rr[$key] = $value;
        }
      }
      $result[] = $rr;
    }
    return $result;
  }
}
