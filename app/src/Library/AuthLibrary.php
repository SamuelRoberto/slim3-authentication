<?php
/**
 * Project: Slim3 Authentication Example
 * File: app/src/Library/AuthLibrary.php
 * Developed by: Samuel Roberto
 * */

namespace App\Library;

use Psr\Log\LoggerInterface;

final class AuthLibrary
{
    private $db;
    private $session;

    public function __construct($db, LoggerInterface $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }

    public function hashPassword($string, $hash_method = 'md5')
    {
        if (function_exists('hash')) {
		return hash($hash_method, UNIQUE_SALT . $string);
    }
        return sha1(UNIQUE_SALT . $string);
    }

    public function loginCheck($email, $password, $user_agent)
    {
        try{
            $user = null;
            $sql = "SELECT * FROM user
                      WHERE email = :email AND password = :password LIMIT 1";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam("email", $email);
            $query -> bindParam("password", $this->hashPassword($password));
            $query -> execute();
            while($row = $query -> fetch()){
                $user = $row;
            }

            $this->logger->info('AuthLibrary Email: ' . $email);
            $this->logger->info('AuthLibrary Password: ' . $this->hashPassword($password));

            if(isset($user)){
                $sql = "UPDATE user SET session = :session
                      WHERE id_user = :id";
                $query = $this->db->prepare($sql);
                $query->bindParam("id", $user['id_user']);
                $query->bindParam("session", $user_agent);
                $query->execute();
                return $user;
            }else
                return false;
        }catch(\Exception $e){
            $this->logger->info('MySQL\' Error in AuthLibrary: ' . $e);
            return false;
        }
    }

    public function sessionCheck($email, $id, $user_agent){
        try{
            $sql = "SELECT id_user FROM user
                      WHERE id_user = :id AND email = :email AND session = :session LIMIT 1";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam("id", $id);
            $query -> bindParam("email", $email);
            $query -> bindParam("session", $user_agent);
            $query -> execute();
            if($row = $query -> fetch())
                return true;
            else
                return false;
        }catch(\Exception $e){
            return false;
        }
    }
}