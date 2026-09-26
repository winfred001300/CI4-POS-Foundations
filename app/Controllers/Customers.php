<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index()
    {
        $customers = [
            [
                'id' => 1,
                'name' => 'Juan Dela Cruz',
                'email' => 'juan@example.com'
            ],
            [
                'id' => 2,
                'name' => 'Maria Santos',
                'email' => 'maria@example.com'
            ],
            [
                'id' => 3,
                'name' => 'Pedro Reyes',
                'email' => 'pedro@example.com'
            ],
            [
                'id' => 4,
                'name' => 'Ana Garcia',
                'email' => 'ana@example.com'
            ],
            [
                'id' => 5,
                'name' => 'Mark Lopez',
                'email' => 'mark@example.com'
            ]
        ];

        return view('customers', ['customers' => $customers]);
    }
}