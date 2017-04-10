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

        $course = CourseModel::create([
            'user_id' => $user["id"],
            'title' => 'My Course',
            'mudule_id' => 1
        ]);

        $atributes = $course->getAttributes();

        $videoUrl = $_GET['url'];

        if (isset($videoUrl) && $videoUrl == ""){
            CourseMeta::created([
                'course_id' => $atributes["id"],
                'module_id' => 1,
                'key'       => 'url',
                'value'     => $_GET["url"]
            ]);
        }
        $redirect =  sprintf("http://%s/%s/courses%s",$_SERVER["HTTP_HOST"], $atributes["id"], urlencode($videoUrl));
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

            $atributes = $courseMeta->getAttributes();
            $videolUrl = urlencode($_GET["url"]);

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

        return $this->getView()->render($response, 'Course/embedded.twig', ['embed'=>$embedText, "videoUrl" => $videolUrl]);
    }

    public function view($request, $response, $args){

        $params         = $request->getParams();
        $courseID       = $args["id"];
        $moduleID       = 1;
        $videoUrl       = null;

        $video = CourseMeta::where('course_id', $courseID)->where('key','url')->first();

        if( is_object($video) && isset($video->value)) {
            if ( $video->value != "" || isset($video->value)) {
                $videoUrl =  $video->value;
            }
        }

        if (isset($params["url"]) && $params["url"] != "") {
            $videoUrl = $params["url"];
        }

        if (isset($videoUrl) && $videoUrl != null) {
            CourseMeta::create([
                'course_id' => $courseID,
                'module_id' => $moduleID,
                'key' => "url",
                'value' => $videoUrl
            ]);
        } else {
            $videoUrl = "https://www.youtube.com/watch?v=frFNQdQfqwM";
        }

        return $this->getView()->render($response, 'Course/new.twig', ['embed'=> $this->getEmbeddedCode($courseID), "videoUrl" => $videoUrl, "idVideo" => $courseID]);
    }

    private function getEmbeddedCode($courseID){
        $url = sprintf("http://%s/%s/courses/emb", $_SERVER["HTTP_HOST"], $courseID);
        $embedText = sprintf("<iframe width=\"560\" height=\"315\" src=\"%s\" frameborder=\"0\" allowfullscreen></iframe>", $url);
        return $embedText;
    }
}