<?php
namespace Thinkific\Controllers\Api;
use PHPUnit\Runner\Exception;
use Thinkific\Controllers\Controller;
use Thinkific\Models\User as UserModel;

/**
 * Created by PhpStorm.
 * User: Thiago Alencar
 * Date: 08/04/17
 * Time: 12:55
 */
class User extends Controller
{
    private $container;

    public function getUser($request, $response, $args){

        try {
            $user = UserModel::find($args['id']);
            if (!isset($user->name)){
                throw new Exception("User not found", 800);
            }

            $result[] = array(
                "name"  => $user->name,
                "email" => $user->email
            );

        } catch (Exception $e){
            $result[] = array(
                    "error"  => $e->getCode(),
                    "message" => $e->getMessage()
                );
        }


        $response = $response->withJson($result,200);
        return $this->getView()->render($response, 'Json.twig', $result);
    }
}