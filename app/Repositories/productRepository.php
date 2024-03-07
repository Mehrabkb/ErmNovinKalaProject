<?php

namespace App\Repositories;

use App\Interfaces\productRepositoryInterface;
use App\Models\productCategory;
use App\Models\publicTags;
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
    public function getAllCategories()
    {
        // TODO: Implement getAllCategories() method.
        return productCategory::all();
    }
    public function getAllTags()
    {
        // TODO: Implement getAllTags() method.
        return publicTags::all();
    }

    public function deleteUnitById($unit_id)
    {
        // TODO: Implement deleteUnitById() method.
        $unit = Unit::where('unit_id' , $unit_id)->first();
        if($unit->delete()){
            return true;
        }
        return false;
    }
    public function getUnitByUnitId($unit_id)
    {
        // TODO: Implement getUnitByUnitId() method.
        return Unit::where('unit_id' , $unit_id)->first();
    }
    public function editUnitBySelectId($unit_id, $data)
    {
        // TODO: Implement editUnitBySelectId() method.
        $unit = Unit::where('unit_id' , $unit_id)->first();
        if($unit){
            $unit->long_title = $data['long_title'];
            $unit->short_title = $data['short_title'];
            if($unit->save()){
                return true;
            }
        }
        return false;
    }
}
