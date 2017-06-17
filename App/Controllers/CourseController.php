<?php
namespace App\Controllers;

use App\Models\Course;
use App\Utils\ParamsChecker;
use App\Utils\Response;

class CourseController {
  private $course;

  function __construct(){
    $this->course = new Course();
  }

  public function createAction($params){
    $paramsBad = ParamsChecker::checkMissingParams($params, [
      'title',
      'description',
      'image'
    ]);

    if($paramsBad){
      return $paramsBad;
    }

    $res = $this->course->create($params['title'], $params['descrition'], $params['image']);

    error_log('res'.print_r($res,1));
    return new Response(200);
  }

  public function listAction(){
    $courses = $this->course->getAll();
    return new Response(200, $courses);
  }
}
