<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

# Route::get('peticion', acción );
Route::get('saludo', function()
{
     return 'Hola Mundo desde Laravel!!';
});
Route::get('/prueba', function ()
{
    return view('primera');
});
Route::get('/segunda', function ()
{
    $nombre = 'marcos';
    return view('segunda', [ 'nombre'=>$nombre ] );
});

Route::get('/inicio', function ()
{
    return view('inicio');
});
