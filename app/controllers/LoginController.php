<?php

namespace app\controllers;

use app\core\View;
use app\database\models\User;
use app\library\Auth;
use app\library\Redirect;
use app\services\AuthService;
use Exception;

class LoginController
{
    private AuthService $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }
    public function index()
    {
        return View::render('login');
    }

    public function store()
    {
        $this->authService->authenticate();
        Redirect::to('/');
    }

    public function destroy()
    {
        $this->authService->logout();
        return Redirect::back();
    }
}