<?php

namespace app\controllers;

use app\core\View as CoreView;
use app\library\Redirect;
use app\library\View;
use app\services\CartService;

class CartController
{
    private CartService $cartService;
    public function __construct()
    {
        $this->cartService = new CartService();
    }
    
    public function index()
    {
        CoreView::render('cart');
    }
    
    public function add()
    {
        $this->cartService->add();        
        return Redirect::to('/');        
    }

    public function update()
    {
        $this->cartService->update();
        return Redirect::to('/cart');
    }

    public function destroy()
    {
        $this->cartService->destroy();
        return Redirect::back();
        
    }
}
