<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $message = $this->getMessage();
        $data = $this->processData();

        return response()->json([
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    private function getMessage(): string
    {
        return "Call Controller";
    }

    private function processData(): array
    {
        $data = [
            ['id' => 1, 'name' => 'John'],
            ['id' => 2, 'name' => 'Jane'],
            ['id' => 3, 'name' => 'Tom'],
        ];

        return $data;
    }
}