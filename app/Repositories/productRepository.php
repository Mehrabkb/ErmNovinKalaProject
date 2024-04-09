<?php

namespace App\Repositories;

use App\Interfaces\productRepositoryInterface;
use App\Models\Product;
use App\Models\productBrand;
use App\Models\productCategory;
use App\Models\productStatus;
use App\Models\publicTags;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $category->image = url($category->image);
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
    public function getBrandByBrandId($brand_id)
    {
        // TODO: Implement getBrandByBrandId() method.
        return productBrand::where('product_brand_id' , $brand_id)->first();
    }
    public function updateBrandById($brand_id, $data)
    {
        // TODO: Implement updateBrandById() method.
        $brand = productBrand::where('product_brand_id' , $brand_id)->first();
        isset($data['brand_name']) ? $brand->brand_name =  $data['brand_name'] : '';
        isset($data['brand_logo']) ? $brand->brand_logo = $data['brand_logo'] : '';
        if($brand->save()){
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
    public function allProductsFrontEndData()
    {
        // TODO: Implement allProductsFrontEndData() method.
        $products = DB::table('products')
            ->join('product_categories' , 'products.product_category_id' , '=' , 'product_categories.product_category_id')
            ->get();
        return $products;
    }
    public function allProductStatuses()
    {
        // TODO: Implement allProductStatuses() method.
        return productStatus::all();
    }
    public function addProduct($data){
        $product = new Product();
        $product->title = $data['product-title'];
        $product->balance = $data['product-balance'];
        $product->price = (int)str_replace( ',' , '' , $data['product-price']);
        $product->company_price = (int)str_replace( ',' , '' , $data['product-company-price']);
        $product->sku = rand(1 , 1000) + Carbon::now()->timestamp;
        $product->product_category_id = $data['product-category-id'];
        $product->product_status_id = $data['product-status-id'];
        $product->user_publisher_id = Auth::user()->user_id;
        $product->active = 1 ;
        $product->product_brand_id = $data['product-brand-id'];
        $product->date = Carbon::now()->timestamp;
        $product->description = $data['product-description'];
        $data['product-tag-id'] != '' ? $product->product_tag_id = $data['product-tag-id'] : '';
        isset($data['image']) ? $product->main_image = $data['image'] : '';
        if($product->save()){
            return true;
        }
        return false;
    }
    public function addCategoryReturnCatId($data)
    {
        // TODO: Implement addCategoryReturnCatId() method.
        $cat = new productCategory();
        $cat->persian_category = $data['persian-category'];
        $cat->parent_category_id = $data['product-category-id'];
        if($cat->save()){
            return $cat->product_category_id;
        }
        return false;
    }
    public function getCategoryByPersianName($persian_name)
    {
        // TODO: Implement getCategoryByPersianName() method.
        $cat = productCategory::where('persian_category' , 'like' , trim($persian_name))->first();
        return $cat;
    }
    public function deleteProductByProductId($product_id)
    {
        // TODO: Implement deleteProductByProductId() method.
        if(Product::where('product_id' , $product_id)->delete()){
            return true;
        }
        return false;

    }
    public function getProductById($product_id)
    {
        // TODO: Implement getProductById() method.
        $product = Product::where('product_id' , $product_id)->first();
        return $product;
    }
    public function editProductById($product_id, $data)
    {
        // TODO: Implement editProductById() method.
        $product = Product::where('product_id' , $product_id)->first();
        $product->title = $data['product-title'];
        $product->balance = $data['product-balance'];
        $product->price = (int)str_replace( ',' , '' , $data['product-price']);
        $product->company_price = (int)str_replace(',' ,'' , $data['product-company-price']);
        $product->sku = rand(1 , 1000) + Carbon::now()->timestamp;
        $product->product_category_id = $data['product-category-id'];
        $product->product_status_id = $data['product-status-id'];
        $product->user_publisher_id = Auth::user()->user_id;
        $product->active = 1 ;
        $product->product_brand_id = $data['product-brand-id'];
        $product->date = Carbon::now()->timestamp;
        $product->description = $data['product-description'];
        $product->off = $data['off'];
        $data['product-tag-id'] != '' ? $product->product_tag_id = $data['product-tag-id'] : '';
        isset($data['image']) ? $product->main_image = $data['image'] : '';
        if($product->save()){
            return true;
        }
        return false;
    }
    public function getProductsCount()
    {
        // TODO: Implement getProductsCount() method.
        return Product::all()->count();
    }
    public function getBrandsCount()
    {
        // TODO: Implement getBrandsCount() method.
        return productBrand::all()->count();
    }
    public function getCategoriesCount()
    {
        // TODO: Implement getCategoriesCount() method.
        return productCategory::all()->count();
    }
    public function updateProductPriceByProductId($productId , $price , $company_price){
        $product = \App\Models\Product::where('product_id' , $productId)->first();
        $product->price =  (int)str_replace( ',' , '' , $price);
        $product->company_price = (int)str_replace(',' , '' , $company_price);
        if($product->save()){
            return $product;
        }
        return false;
    }
    public function updateProductBrandByProductId($productId, $brandId)
    {
        // TODO: Implement updateProductBrandByProductId() method.
        $product = Product::where('product_id' , $productId)->first();
        $product->product_brand_id = $brandId;
        if($product->save()){
            return $product;
        }
        return false;
    }

    public function searchProduct($value, $column)
    {
        // TODO: Implement searchProduct() method.
        $products = Product::where($column , 'LIKE' , '%'.$value.'%')->get();
        return $products;
    }
}
