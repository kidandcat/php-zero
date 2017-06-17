<?php
namespace App\Core;

use App\Utils\Response;


class Router {
  private $routes;

  public function __construct(){
    $this->routes = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/App/Config/routes.ini", true);
  }

  public function responser(Response $r){
    header('Content-Type: application/json');
    http_response_code($r->getStatus());
    echo json_encode($r->getData());
  }

  public function reader(){
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

    if($method == 'GET' && isset($_GET)){
      $params = $this->paramsParser($_GET, 'GET');
    }else{
      $params = $this->paramsParser(file_get_contents("php://input"));
      if(gettype($params) == 'object'){
        return $this->responser($params);
      }
    }

    $res = $this->resolve($method, $path, $params);
    return $this->responser($res);
  }

  public function paramsParser($params, $method = null){
    if($method == 'GET'){
      return $params;
    }else{
      if(!empty($params)){
        $res = json_decode($params, true);
      }
      if(!isset($res)){
        return new Response(400, 'Invalid json');
      }
      return $res;
    }
  }

  public function resolve($method, $path, $parameters = null){
    if(array_key_exists($path, $this->routes)){
      $route = $this->routes[$path];
      if(array_key_exists($method, $route)){
        $controller = 'App\Controllers\\'.$route['controller'].'Controller';
        $c = new $controller();
        $action = $route[$method].'Action';
        return $c->$action($parameters);
      }else{
        return new Response(404, 'Method not supported');
      }
    }else{
      return new Response(404, 'Path not found');
    }
  }
}
