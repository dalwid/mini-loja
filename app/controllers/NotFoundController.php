<?php

namespace app\controllers;

class NotFoundController
{
    public function index()
    {
        // chamar uma view de erro dizendo que o controller não existe
        var_dump('not found');
    }
}