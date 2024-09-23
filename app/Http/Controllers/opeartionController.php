<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalculDpia;

class opeartionController extends Controller
{
    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }

    public function calculerEtEnvoyer(Request $request)
    {
        $port = $request->input('port');
        $prog = $request->input('prog');
        $sous_prog = $request->input('sous_prog');
        $act = $request->input('act');
        $s_act = $request->input('s_act');

        try {
            $resultats = $this->calculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act, $s_act);

               // Renvoyer les résultats en JSON
            return response()->json($resultats);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        }
}
