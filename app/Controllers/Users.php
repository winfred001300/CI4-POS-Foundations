<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $users = [
            [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@example.com'
            ],
            [
                'id' => 2,
                'username' => 'john123',
                'email' => 'john@example.com'
            ],
            [
                'id' => 3,
                'username' => 'maria22',
                'email' => 'maria@example.com'
            ],
            [
                'id' => 4,
                'username' => 'pedro45',
                'email' => 'pedro@example.com'
            ],
            [
                'id' => 5,
                'username' => 'ana2026',
                'email' => 'ana@example.com'
            ]
        ];

        return view('users', ['users' => $users]);
    }
}