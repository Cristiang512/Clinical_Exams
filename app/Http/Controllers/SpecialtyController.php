<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['specialty']=Specialty::paginate(5);

        return view('specialty.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $campos = [
        'name' => ['required', 'string', 'max:255'],
        ];

        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);
        $dataSpecialty=request()->except('_token');

        $dataSpecialty = Specialty::create([
            'name' => $request->name,
        ]);


        return redirect('specialty')->with('mensaje','Especialidad Agregada con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show( $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialty=Specialty::findOrFail($id);
        return view('specialty.edit',compact ('specialty'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos = [
        'name' => ['required', 'string', 'max:255'],
        ];
        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);
        $dataSpecialty=request()->except(['_token','_method']);
        Specialty::where('id','=',$id)->update($dataSpecialty);
        return redirect('specialty')->with('mensaje','Especialidad Modificada con Éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Specialty::destroy($id);
        return redirect('specialty')->with('mensaje','Especialidad Eliminada con Éxito');
    }
}
