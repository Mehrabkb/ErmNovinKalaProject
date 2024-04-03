<?php

namespace App\Interfaces;

interface basketRepositoryInterface
{
    public function checkUserBasket($user_id);
    public function getUserBasket($user_id);
    public function getBasketItems($basket_id);
    public function createBasket($user_id);
    public function addBasketItem($basket_id , $product_id , $count);
    public function updateBasketPrice($basket_id , $price);
    public function getUserBasketFullModelByBasketId($basket_id);
    public function getBasketItemByBasketItemId($basket_item_id);
    public function deleteBasketItemByBasketItemId($basket_item_id);
}
