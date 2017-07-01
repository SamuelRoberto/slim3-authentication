<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/src/Action/LogoutAction.php
 * Developed by: Samuel Roberto
 * */

namespace App\Action;

use SlimSession\Helper;
use Slim\Http\Request;
use Slim\Http\Response;

class LogoutAction
{
    private $session;

    public function __construct(Helper $session)
    {
        $this->session = $session;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $this->session->delete('id');
        $this->session->delete('email');
        $this->session->delete('is_logged');
        $this->session->destroy();
        $response = $response->withRedirect('/login/logoutSuccess');

        return $response;
    }
}