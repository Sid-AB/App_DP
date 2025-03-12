<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
   public function index()
    {
        return view('Admin.index');
    }
}
