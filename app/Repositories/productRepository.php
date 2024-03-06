<?php

namespace App\Repositories;

use App\Interfaces\productRepositoryInterface;
use App\Models\Unit;

class productRepository implements productRepositoryInterface{
    public function addUnit($longTitle, $shortTitle)
    {
        // TODO: Implement addUnit() method.
        $unit = new Unit();
        $unit->long_title = $longTitle ;
        $unit->short_title = $shortTitle;
        if($unit->save()){
            return true;
        }
        return false;
    }
    public function getAllUnits()
    {
        // TODO: Implement getAllUnits() method.
        return Unit::all();
    }
}
