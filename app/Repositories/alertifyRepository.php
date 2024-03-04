<?php

namespace App\Repositories;

use App\Interfaces\alertifyRepositoryInterface;

class alertifyRepository implements alertifyRepositoryInterface{
    public function errorMessage($message)
    {
        // TODO: Implement errorMessage() method.
        return json_encode([
            'type' => 'error',
            'message' => $message
        ]);
    }
    public function successMessage($message)
    {
        // TODO: Implement successMessage() method.
        return json_encode([
            'type' => 'success',
            'message' => $message
        ]);
    }
}
