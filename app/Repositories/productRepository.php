<?php

namespace App\Repositories;

use App\Interfaces\productRepositoryInterface;
use App\Models\productBrand;
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
    public function addCategory($data)
    {
        // TODO: Implement addCategory() method.
        $category = new productCategory();
        $category->english_category = $data['english_category'] != '' ? $data['english_category'] : '' ;
        $category->persian_category = $data['persian_category'];
        $category->tag_id = $data['tag_id'] != '' ? (int)$data['tag_id'] : 0;
        $category->parent_category_id = $data['parent_category_id'] != '' ? (int)$data['parent_category_id']: 0;
        $category->image = $data['image'] != '' ? $data['image'] : '';
        $category->date = Carbon::now()->timestamp;
        if($category->save()){
            return true;
        }
        return false;
    }
    public function getCategoryById($category_id) // with change parent id to parent name
    {
        // TODO: Implement getCategoryById() method.
        $category = productCategory::where('product_category_id' , $category_id)->first();
        $category->parent_category_id = $category->parent_category_id != 0 ? productCategory::where('product_category_id' , $category->parent_category_id)->first()->persian_category : 0;
        return $category;
    }
    public function allCategoriesWithParentName()
    {
        // TODO: Implement allCategoriesWithParentName() method.
        $categories = productCategory::all();
        foreach($categories as $category){
            $category->parent_category_id = $category->parent_category_id != 0 ? $this->getCategoryById($category->parent_category_id)->persian_category : 'خالی';
        }
        return $categories;
    }
    public function deleteCategoryById($product_category_id)
    {
        // TODO: Implement deleteCategoryById() method.
        if($product_category_id > 0) {
            if (productCategory::where('product_category_id', $product_category_id)->delete()) {
                $categories = $this->getAllCategories();
                foreach($categories as $category){
                    if($category->parent_category_id == $product_category_id){
                        $category->delete();
                    }
                }
                return true;
            }
        }
        return false;
    }
    public function getCategoryByIdWithPureData($category_id)
    {
        // TODO: Implement getCategoryByIdWithPureData() method.
        return productCategory::where('product_category_id' , $category_id)->first();
    }

    public function editCategoryById($category_id, $data)
    {
        // TODO: Implement editCategoryById() method.
        $category = $this->getCategoryByIdWithPureData($category_id);
        $category->english_category = $data['english_category'] != '' ? $data['english_category'] : '' ;
        $category->persian_category = $data['persian_category'];
        if($data['tag_id'] != ''){
            $category->tag_id = (int)$data['tag_id'];
        }
        if($data['parent_category_id'] != ''){
            $category->parent_category_id = (int)$data['parent_category_id'];
        }
        if(isset($data['image'])){
            $category->image =  $data['image'] ;
        }
        $category->date = Carbon::now()->timestamp;
        if($category->save()){
            return true;
        }
        return false;
    }
    public function getAllBrand()
    {
        // TODO: Implement getAllBrand() method.
        return productBrand::all();
    }
    public function addBrand($data)
    {
        // TODO: Implement addBrand() method.
        $brand = new productBrand();
        $brand->brand_name = $data['brand_title'];
        isset($data['brand_logo']) ? $brand->brand_logo = $data['brand_logo'] : '';
        $brand->date = Carbon::now()->timestamp;
        if($brand->save()){
            return true;
        }
        return false;
    }
    public function deleteBrandById($brand_id)
    {
        // TODO: Implement deleteBrandById() method.
        if(productBrand::where('product_brand_id' , $brand_id)->delete()){
            return true;
        }else{
            return false;
        }
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
