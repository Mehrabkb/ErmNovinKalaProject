<?php

namespace App\Interfaces;

interface  productRepositoryInterface
{

    // units methods

    public function addUnit($longTitle , $shortTitle);
    public function getAllUnits();
}
