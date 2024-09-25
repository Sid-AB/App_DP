<?php

namespace App\Http\Controllers;
use App\Services\CalculDpia;

use Illuminate\Http\Request;

class opeartionController extends Controller
{
    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }

    public function calculerEtEnvoyer($port, $prog, $sous_prog, $act)
    {
       
        //dd($port, $prog, $sous_prog, $act);
      
       /* $port = $request->input('port');
        $prog = $request->input('prog');
        $sous_prog = $request->input('sous_prog');
        $act = $request->input('act');
        $s_act = $request->input('s_act');
*/
        try {
            $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act);
            dd($resultats );
               // eenvoyer les résultats en JSON
               return view('Action-in.index',compact('port','prog','sous_prog','act','resultats'));
           // return response()->json($resultats);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        }
}
