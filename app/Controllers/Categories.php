<?php

namespace App\Controllers;

class Categories extends BaseController
{
    public function index()
    {
        return view('categories');
    }
}