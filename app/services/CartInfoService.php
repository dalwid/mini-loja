<?php

namespace app\services;

use app\database\models\Product;

class CartInfoService
{
    public static function getCart()
    {
        return $_SESSION['cart']['products'] ?? [];
    }

    public static function getTotal()
    {
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart']['products'] as $product) {
                $total += $product->getPrice() * $product->getQuantity();
            }
        }

        return $total;
        // return $_SESSION['cart']['total'] ?? 0;
    }

    public static function getQuantity(Product $product)
    {
        if (isset($_SESSION['cart']['products']) && array_key_exists($product->slug, $_SESSION['cart']['products'])) {
            return $_SESSION['cart']['products'][$product->slug]->getQuantity();
        }

        return 0;
    }

    public static function getTotalProductsInCart()
    {
        return count(self::getCart());
    }
}
