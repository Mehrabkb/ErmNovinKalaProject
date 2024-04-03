<?php

namespace App\Interfaces;

interface factorRepositoryInterface
{
    public function addFactor($basket_id);
    public function getFactorsByUserId($user_id);
}
