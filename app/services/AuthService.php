<?php

namespace app\services;

use app\database\models\User;
use app\dto\AuthDto;
use Exception;

class AuthService
{
    public function authenticate()
    {
        $email    = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $user = User::where('email', $email);
        
        if (!$user) {
            throw new Exception("Usuário inválidos");
        }

        if (!password_verify($password, $user->password)) {
            throw new Exception("Usuário ou senha inválidos inválidos");            
        }

        $this->loginAs($user); 
    }

    private function loginAs(User $user)
    {
        if (!isset($_SESSION['auth'])) {
            $authDto = new AuthDto($user->id, $user->firstName, $user->lastName);            
            $_SESSION['auth'] = $authDto;
        }
    }
    
    public function logout()
    {
        if (isset($_SESSION['auth'])) {
            unset($_SESSION['auth']);
        }
    }
}
