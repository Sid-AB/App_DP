<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Services\CalculDpia;

use Barryvdh\DomPDF\Facade\pdf;
class sousOperationController extends Controller
{

    protected $CalculDpia;

    public function __construct(CalculDpia $CalculDpia)
    {
        $this->CalculDpia = $CalculDpia;
    }


    function AffichePortsAction ($port,$prog,$sous_prog,$act)
    {
            try{
        $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$act);
        //dd($resultats);
           return view('Action-in.index',compact('port','prog','sous_prog','act','resultats'));
   
       } catch (\Exception $e) {
           // en cas d'erreur retourner un message d'erreur 
           return response()->view('errors.not_found', [], 404);
       }
   
   
    }

    function AffichePortsSousAct ($port,$prog,$sous_prog,$act,$s_act)
    {
      //  dd($port,$prog,$sous_prog,$act,$s_act);
      //$resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
     // dd($resultats);
        try{
            $resultats = $this->CalculDpia->calculdpiaFromPath($port, $prog, $sous_prog, $act,$s_act);
               return view('Action-in.index',compact('port','prog','sous_prog','act','resultats'));
           } catch (\Exception $e) {
               // en cas d'erreur retourner un message d'erreur 
               return response()->view('errors.not_found', [], 404);
           }


       
   }

   public function impressionpdf()
   {
    
   }


        
   
}
