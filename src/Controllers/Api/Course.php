<?php
/**
 * Created by PhpStorm.
 * User: thiagoalencar
 * Date: 09/04/17
 * Time: 01:51
 */

namespace Thinkific\Controllers\Api;
use Thinkific\Controllers\Controller;
use Thinkific\Models\CourseMeta;

class Course extends Controller
{
    public function getEmbedded($request, $response, $args){
        $embedded =  sprintf("<iframe width=\"560\" height=\"315\" src=\"http://%s/%s/courses/emb\" frameborder=\"0\" allowfullscreen></iframe>",$_SERVER["HTTP_HOST"], $args["id"]);
        echo $embedded;
    }

    public function getQuestions($request, $response, $args){

        $courseItems    = CourseMeta::where("key", "_question")
                                    ->where("key", "_title")
                                    ->where("key", "_start")
                                    ->where("key", "_answer");

        foreach ($courseItems as $courseItem) {
            echo $courseItem->key;
        }

        $result = array(
            "questions" => array(
                array(
                    "title" => "Quem descobriu o Brasil?",
                    "id"    => 1,
                    "start" => 1,
                    "answer" => array(
                        "a" => "Pedro Alvares Cabral",
                        "b" => "Pedro Alvares Cabrel",
                        "c" => "Pedro Alvares Cabril",
                        "d" => "Pedro Alvares Cabrol",
                    )
                ),
                array(
                    "title" => "Quem descobriu o Brasil?",
                    "id"    => 1,
                    "start" => 2,
                    "answer" => array(
                        "a" => "Pedro Alvares Cabral",
                        "b" => "Pedro Alvares Cabrel",
                        "c" => "Pedro Alvares Cabril",
                        "d" => "Pedro Alvares Cabrol",
                    )
                )
            )
        );

        $response = $response->withJson($result,200);
        return $this->getView()->render($response, 'Json.twig');
    }

    public function saveQuestions($request, $response, $args){
        var_dump($request->getParams());
        $result = array(
            "status" => "ok"
        );

        $response = $response->withJson($result,200);
        return $this->getView()->render($response, 'Json.twig');
    }
}