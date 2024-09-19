<?php

use App\Http\Controllers\actionController;
use App\Http\Controllers\portfeuilleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/testing',function (){
return view('test.carsoule');
});
Route::get('/testing/tree',function (){
    return view('test.tree');
    });
    Route::get('/testing/Action',function (){
        return view('Action-in.index');
        });
//Route::get('/Portfail',action: [portfeuilleController::class,'affich_portef'])->name('home.portfail');


//===============ROUTE PORTEFEUILLE==============================
Route::controller(portfeuilleController::class)->group(function(){
    Route::get('/Portfail','affich_portef')->name('home.portfail');
    Route::get('/creation','create_vportef')->name('creation.portfail');
});

//===============ROUTE PROGRAMME==============================
Route::controller(programmeController::class)->group(function(){
    Route::get('/Programme','affich_prog')->name('home.programme');
    Route::get('/creationProg','creat_prog')->name('creation.programme');
});

//===============ROUTE SOUS PROGRAMME==============================
Route::controller(sousProgrammeController::class)->group(function(){
    Route::get('/SousProgramme','affich_sou_prog')->name('home.sousProgramme');
    Route::get('/creationSousProg','create_sou_prog')->name('creation.souProgramme');
});

//===============ROUTE ACTION==============================
Route::controller(actionController::class)->group(function(){
    Route::get('/Action','affich_action')->name('action.detail');
    Route::get('/creationProg','creat_prog')->name('creation.programme');
});

//===============ROUTE SOUS ACTION==============================
Route::controller(sousActionController::class)->group(function(){
});

//===============ROUTE GROUPE D'OPERATIONS==============================
Route::controller(groupOperationController::class)->group(function(){
});

//===============ROUTE  OPERATION==============================
Route::controller(operationController::class)->group(function(){
});

//===============ROUTE SOUS OPERATION==============================
Route::controller(sousOperationController::class)->group(function(){
});
