<?php
namespace App\Controllers;

use App\Models\Menu;
use App\Utils\ParamsChecker;
use App\Utils\Response;

class MenuController {
  private $menu;

  public function __construct(){
    $this->menu = new Menu();
  }

  public function createAction($params){
    $paramsBad = ParamsChecker::checkMissingParams($params, [
      'name',
      'link'
    ]);

    if($paramsBad){
      return $paramsBad;
    }

    $res = $this->menu->create($params['name'], $params['link']);

    return new Response(200);
  }

  public function listAction(){
    $menus = $this->menu->getAll();
    return new Response(200, $menus);
  }
}
