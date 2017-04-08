<?php
namespace Thinkific\Controllers\Course;
use Thinkific\Controllers\Controller;

/**
 * Created by Thiago Alencar.
 * User: thiagoalencar
 * Date: 08/04/17
 * Time: 17:59
 */
class CourseController extends Controller
{
    public function new($request, $response){
        return $this->getView()->render($response, 'Course/new.twig');
    }
}