<?php

namespace app\controllers;

use app\library\Redirect;
use app\services\CheckoutService;
use Exception;

class CheckoutController
{
    public function checkout()
    {
        try {
            $checkout = new CheckoutService();
            $checkout_session = $checkout->checkout();
            Redirect::to($checkout_session->url);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
