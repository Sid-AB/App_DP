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
Route::get('/Portfail',[PortfailDetails::class,'index'])->name('home.portfail');
