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

############################################
#### CRUD de regiones
Route::get('/adminRegiones', function () {
    //obtenemos listado de regiones
    $regiones = DB::select('SELECT regID, regNombre FROM regiones');
    return view('adminRegiones', [ 'regiones'=>$regiones ]);
});
Route::get('/agregarRegion', function ()
{
    return view('agregarRegion');
});
Route::post('/agregarRegion', function ()
{
    //capturamos dato enviados por el form
    $regNombre = $_POST['regNombre'];
    //insertamos en tabla regiones
    DB::insert(
                'INSERT INTO regiones
                                    ( regNombre )
                                VALUE
                                    ( :regNombre )',
                [ $regNombre ]
        );

    //redirección con mensaje ok
    return redirect('/adminRegiones')
                ->with( [ 'mensaje'=>'Región: '.$regNombre.' agregada correctamente' ] );
});
Route::get('/modificarRegion/{id}', function($id)
{
    //obtenemos region por id
    /*$region = DB::select('SELECT regID, regNombre
                                FROM regiones
                                WHERE regID = :id',
                        [ $id ]
                    );*/
    $region = DB::table('regiones')
                    ->where('regID', $id)
                    ->first();
    //retornamos vista del form con datos
    return view('modificarRegion', [ "region" => $region ]);
});
Route::put('/modificarRegion', function ()
{
    //capturamos datos
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    //modificamos
    /* DB::update('UPDATE regiones
                    SET regNombre = :regNombre
                   WHERE regID = :regID',
                [ $regNombre, $regID ]
        );*/
    DB::table('regiones')
        ->where('regID', $regID)
        ->update( ['regNombre'=>$regNombre]);
    //redirección con mensaje ok
    return redirect('/adminRegiones')
        ->with( [ 'mensaje'=>'Región: '.$regNombre.' modificada correctamente' ] );
});

############################################
#### CRUD de destinos
Route::get('/adminDestinos', function ()
{
    //obtenemos listado de destinos
    /*
    $destinos = DB::select('SELECT *
                                FROM destinos
                                INNER JOIN regiones
                                  ON destinos.regID = regiones.regID');
    */
    $destinos = DB::table('destinos')
                    ->join('regiones', 'destinos.regID', '=', 'regiones.regID')
                    ->get();
    //retornamos vista con datos
    return view('adminDestinos',[ "destinos" => $destinos ]);
});
Route::get('/agregarDestino', function ()
{
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    return view('agregarDestino', [ 'regiones'=>$regiones ]);
});
Route::post('/agregarDestino', function ()
{
    //capturar datos
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    //insertar datos en tabla
    DB::table('regiones')
                ->insert(
                        [
                            'destNombre'=>$destNombre,
                            'regID'=>$regID,
                            'destPrecio'=>$destPrecio,
                            'destAsientos'=>$destAsientos,
                            'destDisponibles'=>$destDisponibles
                        ]
                );
    //redirección con mensaje ok
    return redirect('/adminDestinos')
                ->with(['mensaje'=>'Destino: '.$destNombre.' agregado correctamente.']);
});
Route::get('/modificarDestino/{id}', function ($id)
{
    //obtenemos datos de un destino por su id
    $destino = DB::table('destinos')
                    ->where('destID', $id)
                    ->first();
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    return view('modificarDestino',
                        [
                            "destino" => $destino,
                            "regiones" => $regiones
                        ]);
});
