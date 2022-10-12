<?php

namespace src;

use src\DataBaseConnection;
use modules\user\models\User;

class Auth 
{
    public function checkLogin($username, $password)
    {
        $dbh = DataBaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $userObj = new User($dbc);
        $userObj->findBy('username', $username);

        if (property_exists($userObj, 'id')) 
        {
            if (password_verify($password, $userObj->password)) 
            {
                return true;
            }
        }
    }

    public function changeUserPassword($userObj, $newPassword)
    {
        $userObj->password = password_hash($newPassword, PASSWORD_DEFAULT);

        return $userObj;
    }
    
}