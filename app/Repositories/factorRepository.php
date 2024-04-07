<?php

namespace App\Repositories;

use App\Interfaces\factorRepositoryInterface;
use App\Models\Factor;
use App\Models\factorItem;
use Carbon\Carbon;

class factorRepository implements factorRepositoryInterface
{
    public function __construct(basketRepository $basketRepository , productRepository $productRepository)
    {
        $this->basketRepository = $basketRepository;
        $this->productRepository = $productRepository;
    }

    public function addFactor($basket_id)
    {
        // TODO: Implement addFactor() method.
        $basket = $this->basketRepository->getUserBasketFullModelByBasketId($basket_id);
        $basketItems = $this->basketRepository->getBasketItems($basket_id);
        $factor = new Factor();
        $factor->user_id = $basket->user_id;
        $factor->total_price = $basket->total_price;
        $factor->date = Carbon::now()->timestamp;
        if($factor->save()){
            foreach($basketItems as $basketItem){
                $product = $this->productRepository->getProductById($basketItem->product_id);
                $factorItem = new factorItem();
                $factorItem->factor_id = $factor->factor_id;
                $factorItem->product_id = $basketItem->product_id;
                $factorItem->count = $basketItem->count;
                $factorItem->off = $product->off;
                $factorItem->price = $product->price;
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
        $factors = Factor::where('user_id' , $user_id)->orderBy('date' , 'DESC')->get();
        foreach($factors as $factor){
            switch ($factor->status){
                case 'pre-factor':
                    $factor->status = 'پیش فاکتور';
                    break;
            }
        }
        return $factors;
    }
    public function getFactorsByStatus($user_id , $status)
    {
        // TODO: Implement getFactorsByStatus() method.
        return Factor::where([['status' , '=' ,  $status] , ['user_id' , '=' , $user_id]] )->get();
    }
}
