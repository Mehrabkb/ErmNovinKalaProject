<?php

namespace App\Interfaces;

interface alertifyRepositoryInterface
{
    public function errorMessage($message);
    public function successMessage($message);
}

