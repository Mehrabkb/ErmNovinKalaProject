<?php

namespace App\Repositories;

use App\Interfaces\factorRepositoryInterface;
use App\Models\Factor;
use App\Models\factorItem;

class factorRepository implements factorRepositoryInterface
{
    public function __construct(basketRepository $basketRepository)
    {
        $this->basketRepository = $basketRepository;
    }

    public function addFactor($basket_id)
    {
        // TODO: Implement addFactor() method.
        $basket = $this->basketRepository->getUserBasketFullModelByBasketId($basket_id);
        $basketItems = $this->basketRepository->getBasketItems($basket_id);
        $factor = new Factor();
        $factor->user_id = $basket->user_id;
        $factor->total_price = $basket->total_price;
        if($factor->save()){
            foreach($basketItems as $basketItem){
                $factorItem = new factorItem();
                $factorItem->factor_id = $factor->factor_id;
                $factorItem->product_id = $basketItem->product_id;
                $factorItem->count = $basketItem->count;
                if($factorItem->save()){
                    $basketItem->delete();
                }
            }
            if($basket->delete()){
                return true;
            }
        }
        return false;
    }
    public function getFactorsByUserId($user_id)
    {
        // TODO: Implement getFactorsByUserId() method.
        $factor = Factor::where('user_id' , $user_id)->get();
        return $factor;
    }
}
