<?php

use App\Http\Controllers\PortfailDetails;
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
//Route::get('/Portfail',[PortfailDetails::class,'index'])->name('home.portfail');


//===============ROUTE PORTEFEUILLE==============================
Route::controller(portfeuilleController::class)->group(function(){
    Route::get('/Portfail','index')->name('home.portfail');
});

//===============ROUTE PROGRAMME==============================
Route::controller(programmeController::class)->group(function(){
});

//===============ROUTE SOUS PROGRAMME==============================
Route::controller(sousProgrammeController::class)->group(function(){
});

//===============ROUTE ACTION==============================
Route::controller(actionController::class)->group(function(){
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
