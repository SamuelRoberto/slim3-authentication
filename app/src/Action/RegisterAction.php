<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/src/Action/RegisterAction.php
 * Developed by: Samuel Roberto
 * */

namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Library\AuthLibrary;
use App\Library\UserLibrary;
use SlimSession\Helper;

final class RegisterAction
{
    private $view;
    private $logger;
    private $session;
    private $auth;
    private $user;

    public function __construct(Twig $view, LoggerInterface $logger, Helper $session, AuthLibrary $auth, UserLibrary $user)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->session = $session;
        $this->auth = $auth;
        $this->user = $user;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        $this->view->render($response, 'register.twig');
        return $response;
    }

    public function registerPost(Request $request, Response $response, $args){
        $req = $request->getParsedBody();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if($this->user->createUser($req['email'], $req['password'], $user_agent)){
            if($user = $this->auth->loginCheck($req['email'], $req['password'], $user_agent)) {
                $this->session->id = $user['id_user'];
                $this->session->email = $user['email'];
                $this->session->is_logged = true;

                $response = $response->withRedirect('/user/profile');
            }else
                $response = $response->withRedirect('/register/fail');
        }else
            $response = $response->withRedirect('/register/fail');


        return $response;
    }
}