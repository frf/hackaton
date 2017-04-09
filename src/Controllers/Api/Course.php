<?php
/**
 * Created by PhpStorm.
 * User: thiagoalencar
 * Date: 09/04/17
 * Time: 01:51
 */

namespace Thinkific\Controllers\Api;
use Thinkific\Controllers\Controller;

class Course extends Controller
{
    public function getEmbedded($request, $response, $args){
        $embedded =  sprintf("<iframe width=\"560\" height=\"315\" src=\"http://%s/%s/courses/emb\" frameborder=\"0\" allowfullscreen></iframe>",$_SERVER["HTTP_HOST"], $args["id"]);
        echo $embedded;
    }
}