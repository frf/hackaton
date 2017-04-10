<?php
namespace Thinkific\Controllers\Course;
use Thinkific\Controllers\Controller;
use Thinkific\Models\Course as CourseModel;
use Thinkific\Models\CourseMeta;

/**
 * Created by Thiago Alencar.
 * User: thiagoalencar
 * Date: 08/04/17
 * Time: 17:59
 */
class CourseController extends Controller
{
    public function new($request, $response){
        $container = $this->getContainer();
        $user = $container->authentication->getUser();
        $params = $request->getParams();

        error_log(var_dump($params));
        $queryString = (isset($_SERVER['QUERY_STRING'])) ? sprintf("?" . $_SERVER['QUERY_STRING']) : "";

        $course = CourseModel::create([
                'user_id' => $user["id"],
                'title' => 'My Course',
                'mudule_id' => 1
        ]);

        $courseMeta = CourseMeta::create([
            'course_id' => $params["id"],
            'module_id' => 1,
            'key'       => 'query_string',
            'value'     => $_SERVER["QUERY_STRING"]
        ]);

        $atributes = $course->getAttributes();

        $redirect =  sprintf("http://%s/%s/courses%s",$_SERVER["HTTP_HOST"], $atributes["id"], $queryString);
        header("Location: $redirect");
        exit();
    }

    public function embedded($request, $response, $args){

        if (isset($_SERVER["QUERY_STRING"])){
            $courseMeta = CourseMeta::create([
                'course_id' => $args["id"],
                'module_id' => 1,
                'key'       => 'query_string',
                'value'     => $_SERVER["QUERY_STRING"]
            ]);
        } else {
            $courseMeta = CourseMeta::where('course_id', $args["id"])->where('key','query_string')->first();
            if(isset($courseMeta->value)){
                $redirect = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PATH_INFO"] . "?" . $courseMeta->value;
                echo $redirect;
                header("Location: $redirect");
                exit();
            }
        }

        $host = "http://" . $_SERVER["HTTP_HOST"] . "/" . $args["id"] . "/courses/emb";
        $embedText = "<iframe width=\"560\" height=\"315\" src=\"$host\" frameborder=\"0\" allowfullscreen></iframe>";


        return $this->getView()->render($response, 'Course/embedded.twig');
    }

    public function view($request, $response, $args){

        if (isset($_SERVER["QUERY_STRING"])){
            $courseMeta = CourseMeta::create([
                'course_id' => $args["id"],
                'module_id' => 1,
                'key'       => 'query_string',
                'value'     => $_SERVER["QUERY_STRING"]
            ]);
        } else {
            $courseMeta = CourseMeta::where('course_id', $args["id"])->where('key','query_string')->first();
            if(isset($courseMeta->value)){
                $redirect = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PATH_INFO"] . "?" . $courseMeta->value;
                echo $redirect;
                header("Location: $redirect");
                exit();
            }
        }

        $videolUrl = (isset($_GET["url"])) ? $_GET["url"] : "https://www.youtube.com/watch?v=frFNQdQfqwM";

        $host = "http://" . $_SERVER["HTTP_HOST"] . "/" . $args["id"] . "/courses/emb";
        $embedText = "<iframe width=\"560\" height=\"315\" src=\"$host\" frameborder=\"0\" allowfullscreen></iframe>";


        return $this->getView()->render($response, 'Course/new.twig', ['embed'=>$embedText, "videoUrl" => $videolUrl]);
    }
}