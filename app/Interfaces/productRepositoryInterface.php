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
}
