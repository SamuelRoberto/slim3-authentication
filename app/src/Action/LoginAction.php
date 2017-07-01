<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/src/Action/LoginAction.php
 * Developed by: Samuel Roberto
 * */

namespace App\Action;

use SlimSession\Helper;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Library\AuthLibrary;

final class LoginAction
{
    private $view;
    private $logger;
    private $auth;
    private $session;

    public function __construct(Twig $view, LoggerInterface $logger, AuthLibrary $auth, Helper $session)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->auth = $auth;
        $this->session = $session;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        $this->view->render($response, 'login.twig', ["option" => $args['option']]);
        return $response;
    }

    public function loginPost(Request $request, Response $response, $args){
        $req = $request->getParsedBody();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if($user = $this->auth->loginCheck($req['email'], $req['password'], $user_agent)){
            $this->session->id = $user['id_user'];
            $this->session->email = $user['email'];
            $this->session->is_logged = true;

            $response = $response->withRedirect('/user/profile');
        }else
            $response = $response->withRedirect('/login/fail');


        return $response;
    }
}