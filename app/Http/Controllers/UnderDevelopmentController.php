<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnderDevelopmentController extends Controller
{
    public function index()
    {
        return view('admin.under-development.index');
    }
}
