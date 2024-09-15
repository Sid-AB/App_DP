<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class portfeuilleController extends Controller
{
//affichage de la portrefeuille
    function affich_portef()
    {
        return view('Portfail-in.index');
    }

// creation de la portefeuille
    function creat_portef()
    {
        return view('Portfail-in.creat');
    }
}
