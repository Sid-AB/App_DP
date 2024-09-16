<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class actionController extends Controller
{
    public function afficher_detail()
    {
        return view('Action-in.index');
    }
}
