<?php

namespace App\Interfaces;

interface  productRepositoryInterface
{

    // units methods

    public function addUnit($longTitle , $shortTitle);
    public function getAllUnits();
    public function deleteUnitById($unit_id);
    public function getUnitByUnitId($unit_id);
    public function editUnitBySelectId($unit_id , $data);
    public function getAllCategories();
    public function getAllTags();
    public function addTag($data);
    public function deleteTag($tag_id);
    public function getTagById($tag_id);
    public function editTagById($tag_id , $data);
    public function addCategory($data);
    public function getCategoryById($category_id);
    public function allCategoriesWithParentName();
    public function deleteCategoryById($product_category_id);
    public function editCategoryById($category_id , $data);
    public function getCategoryByIdWithPureData($category_id);
    public function getAllBrand();
    public function addBrand($data);
    public function deleteBrandById($brand_id);
    public function getBrandByBrandId($brand_id);
    public function updateBrandById($brand_id , $data);
    public function allProductsFrontEndData();
    public function allProductStatuses();
    public function addProduct($data);
    public function addCategoryReturnCatId($data);
    public function getCategoryByPersianName($persian_name);
    public function deleteProductByProductId($product_id);
    public function getProductById($product_id);
    public function editProductById($product_id , $data);
    public function getProductsCount();
    public function getBrandsCount();
    public function getCategoriesCount();
    public function updateProductPriceByProductId($productId , $price , $company_price);
    public function updateProductBrandByProductId($productId , $brandId);
    public function searchProduct($value , $column);
    public function getProductsByCategoryId($category_id);
    public function getProductByCatIdBrandId($category_id , $brand_id);
    public function getProductFeatures();
    public function addProductFeature($feature_key);
    public function addProductFeatureConnection($product_feature_key_id , $product_feature_value , $product_id);
}
