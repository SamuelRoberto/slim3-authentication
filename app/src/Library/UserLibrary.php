<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/src/Library/UserLibrary.php
 * Developed by: Samuel Roberto
 * */

namespace App\Library;

use Psr\Log\LoggerInterface;

final class UserLibrary
{
    private $auth;
    private $db;
    private $logger;

    public function __construct($db, AuthLibrary $auth, LoggerInterface $logger)
    {
        $this->db = $db;
        $this->auth = $auth;
        $this->logger = $logger;
    }

    public function createUser($email, $password, $user_agent)
    {
        try{
            $sql = "INSERT INTO user (email, password, session)
                      VALUES (:email, :password, :session)";
            $query = $this->db->prepare($sql);
            $query->bindParam("email", $email);
            $query->bindParam("password", $this->auth->hashPassword($password));
            $query->bindParam("session", $user_agent);
            $query->execute();

            return true;
        }catch(\Exception $e){
            $this->logger->info('MySQL\'s Error in UserLibrary: ' . $e);
            return false;
        }
    }
}