<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas
        //DB::select('SELECT ... FROM ...')
        //DB::table('marcas')->get()
        $marcas = Marca::paginate(7);
        return view('adminMarcas', [ 'marcas'=>$marcas ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //capturamos dato enviado por el form
        $mkNombre = $request->mkNombre;
        //validación
        $request->validate(
                        [ 'mkNombre'=>'required|min:2|max:50' ],
                        [
                           'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio.',
                           'mkNombre.min'=>'El campo "Nombre de la marca" debe contener al menos 2 caractéres.',
                           'mkNombre.max'=>'El campo "Nombre de la marca" debe contener 50 caractéres como máximo.'
                        ]
                    );
        //instanciar, asignar y guardar en BD
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirección con mensaje ok
        return redirect('/adminMarcas')
            ->with( [ 'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente' ] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de una marca
        //DB::table('marcas')->where()->first()
        $Marca = Marca::find($id);
        //retornamos vista con datos de la marca
        return view('modificarMarca', [ 'Marca'=>$Marca ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
