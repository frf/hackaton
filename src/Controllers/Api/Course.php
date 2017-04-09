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

    public function getQuestions($request, $response, $args){
        $result = array(
            "Questions" => array(
                array(
                    "title" => "Quem descobriu o Brasil?",
                    "id"    => 1,
                    "start" => 100,
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
                    "start" => 100,
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
                    "start" => 100,
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
                    "start" => 100,
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
                    "start" => 100,
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
                    "start" => 100,
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
                    "start" => 100,
                    "answer" => array(
                        "a" => "Pedro Alvares Cabral",
                        "b" => "Pedro Alvares Cabrel",
                        "c" => "Pedro Alvares Cabril",
                        "d" => "Pedro Alvares Cabrol",
                    )
                ),
            )
        );

        $response = $response->withJson($result,200);
        return $this->getView()->render($response, 'Json.twig');
    }

    public function saveQuestions($request, $response, $args){
        $result = array(
            "status" => "ok"
        );

        $response = $response->withJson($result,200);
        return $this->getView()->render($response, 'Json.twig');
    }
}