<?php
namespace Thinkific\Controllers\Api;
use Thinkific\Controllers\Controller;
use Thinkific\Models\Email as EmailModel;
use Respect\Validation\Validator;

/**
 * Created by PhpStorm.
 * User: Thiago Alencar
 * Date: 08/04/17
 * Time: 12:55
 */
class Email extends Controller
{

    public function new($request, $response){

        $returnCode = 200;
        $validation = $this->getValidator()->validate($request, [
            'email' => Validator::noWhitespace()->notEmpty()->email()->emailAvailable()
        ]);

        if ($validation->failed()){
            $result[] = array(
                "status"    => "error",
                "message"   => "Error to register email"
            );
        }

        if (!isset($result)){
            $email = EmailModel::firstOrCreate([
                'email' => $request->getParam('email')
            ]);
            $result[] = array(
                "status"    => "success",
                "message"   => "Email successfully registered"
            );
        }

        $response = $response->withJson($result,$returnCode);
        return $this->getView()->render($response, 'Json.twig');
    }
}