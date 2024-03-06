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
}
