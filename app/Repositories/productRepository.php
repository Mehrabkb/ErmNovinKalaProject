<?php

namespace App\Repositories;

use App\Interfaces\productRepositoryInterface;
use App\Models\productCategory;
use App\Models\publicTags;
use App\Models\Unit;
use Carbon\Carbon;

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
    public function addTag($data)
    {
        // TODO: Implement addTag() method.
        $tag = new publicTags();
        $tag->tags_title = $data['tags-title'];
        $tag->tags_value = $data['tags-value'];
        $tag->date = Carbon::now()->timestamp;
        if($tag->save()){
            return true;
        }
        return false;
    }
    public function deleteTag($tag_id)
    {
        // TODO: Implement deleteTag() method.
        $tag = publicTags::where('public_tag_id' , $tag_id)->first();
        if($tag->delete()){
            return true;
        }
        return false;
    }
    public function getTagById($tag_id)
    {
        // TODO: Implement getTagById() method.
        return publicTags::where('public_tag_id' , $tag_id)->first();
    }
    public function editTagById($tag_id , $data)
    {
        // TODO: Implement editTagById() method.
        $tag = publicTags::where('public_tag_id' , $tag_id)->first();
        $tag->tags_title = $data['tags-title'];
        $tag->tags_value = $data['tags-value'];
        if($tag->save()){
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
