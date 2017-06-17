<?php
namespace App\Utils;


class ParamsChecker {
  public static function checkMissingParams(Array $params, Array $must){
    foreach ($must as $value) {
      if(!array_key_exists($value, $params)){
        return new Response(400, 'missing parameters');
      }
    }
    return false;
  }
}
