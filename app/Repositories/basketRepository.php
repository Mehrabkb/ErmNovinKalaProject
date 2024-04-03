<?php

namespace App\Repositories;

use App\Interfaces\basketRepositoryInterface;
use App\Models\Basket;
use App\Models\BasketItem;
use Carbon\Carbon;

class basketRepository implements basketRepositoryInterface
{
    public function checkUserBasket($user_id)
    {
        $basket = Basket::where([['user_id' , '=' , $user_id] , ['status' , '=' , 'first-step']])->first();
        if($basket){
            return $basket->basket_id;
        }
        return false;
    }
    public function getUserBasket($user_id)
    {
        // TODO: Implement getUserBasket() method.
        $basket = Basket::where([['user_id' , '=' , $user_id] , ['status' , '=' , 'first-step']])->first();
        return $basket->basket_id;
    }
    public function getUserBasketFullModelByBasketId($basket_id)
    {
        // TODO: Implement getUserBasketFullModelByBasketId() method.
        $basket = Basket::where([['basket_id' , '=' , $basket_id] , ['status' , '=' , 'first-step']])->first();
        return $basket;
    }

    public function getBasketItems($basket_id)
    {
        // TODO: Implement getBasketItems() method.
        $basketItems = BasketItem::where('basket_id' , $basket_id)
            ->join('products' , 'products.product_id' , '=' , 'basket_items.product_id')
            ->get();
        return $basketItems;
    }

    public function createBasket($user_id)
    {
        // TODO: Implement createBasket() method.
        $basket = new Basket();
        $basket->user_id = $user_id;
        $basket->date = Carbon::now()->timestamp;
        if($basket->save()){
            return $basket->basket_id;
        }
        return false;
    }
    public function addBasketItem($basket_id , $product_id , $count)
    {
        // TODO: Implement addBasketItem() method.
        $basketItem = new BasketItem();
        $basketItem->basket_id = $basket_id;
        $basketItem->product_id = $product_id;
        $basketItem->count = $count;
        if($basketItem->save()){
            return true;
        }
        return false;
    }
    public function updateBasketPrice($basket_id , $price)
    {
        // TODO: Implement updateBasketPrice() method.
        $basket = Basket::where('basket_id' , $basket_id)->first();
        $basket->total_price = (int)str_replace(',' , '' , $price);
        $basket->save();
    }
    public function getBasketItemByBasketItemId($basket_item_id)
    {
        // TODO: Implement getBasketItemByBasketItemId() method.
        $basketItem = BasketItem::where('basket_item_id' , $basket_item_id)->first();
        return $basketItem;
    }
    public function deleteBasketItemByBasketItemId($basket_item_id)
    {
        // TODO: Implement deleteBasketItemByBasketItemId() method.
        $basketItem = BasketItem::where('basket_item_id' , $basket_item_id)->first();
        if($basketItem->delete()){
            return true;
        }
        return false;
    }
}
