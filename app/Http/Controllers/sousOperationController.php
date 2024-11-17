<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sousOperationController extends Controller
{

    function AffichePortsAction ($port,$prog,$sous_prog,$act)
    {



        return view('Action-in.index',compact('port','prog','sous_prog','act'));
    }

    function AffichePortsSousAct ($port,$prog,$sous_prog,$act,$s_act)
    {



        return view('Action-in.index',compact('port','prog','sous_prog','act','s_act'));
    }
}
