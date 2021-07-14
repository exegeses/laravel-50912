<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
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
     * @param Request $request
     */
    private function validarForm(Request $request): void
    {
        $request->validate(
            ['mkNombre' => 'required|min:2|max:50'],
            [
                'mkNombre.required' => 'El campo "Nombre de la marca" es obligatorio.',
                'mkNombre.min' => 'El campo "Nombre de la marca" debe contener al menos 2 caractéres.',
                'mkNombre.max' => 'El campo "Nombre de la marca" debe contener 50 caractéres como máximo.'
            ]
        );
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
        $this->validarForm($request);
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
    public function update(Request $request)
    {
        $mkNombre = $request->mkNombre;
        //validación
        $this->validarForm($request);
        //modificación
        $idMarca = $request->idMarca;
        $Marca = Marca::find($idMarca);
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirección con mensaje ok
        return redirect('/adminMarcas')
            ->with( [ 'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente' ] );
    }

    private function productoPorMarca($idMarca)
    {
        //$check = Producto::where('idMarca', $idMarca)->first();
        //$check = Producto::firstWhere('idMarca', $idMarca);
        $check = Producto::where('idMarca', $idMarca)->count();
        return $check;
    }

    public function confirmarBaja($id)
    {
        //obtenemos datos de una marca
        $Marca = Marca::find($id);
        ## chequear si NO hay un producto de esa marca
        if( $this->productoPorMarca($id) == 0 ){
            return view('eliminarMarca', [ 'Marca'=>$Marca ]);
        }
        ## redirección a adminMarca con mensaje
        return redirect('/adminMarcas')
            ->with( [ 'mensaje'=>'No se puede borrar: '.$Marca->mkNombre.' porque tiene productos relacionados.' ] );
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
