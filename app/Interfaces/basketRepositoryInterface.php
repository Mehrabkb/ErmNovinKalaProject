<?php

namespace App\Interfaces;

interface basketRepositoryInterface
{
    public function checkUserBasket($user_id);
    public function getUserBasket($user_id);
    public function getBasketItems($basket_id);
    public function createBasket($user_id);
    public function addBasketItem($basket_id , $product_id , $count);
}
