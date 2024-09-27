<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['service'] = Service::leftJoin('especialidad', 'especialidad.id', '=', 'servicio.specialty_id')
        ->select(
        'servicio.id',
        'servicio.name',
        'especialidad.name AS specialty'
        )
        ->get();

        return view('service.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $specialty = Specialty::all();
        return view('service.create',compact('specialty'));
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
        'specialty_id'=>'required|integer',
        ];

        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);

        $dataService=request()->except('_token');

        $dataService = Service::create([
            'name' => $request->name,
            'specialty_id' => $request->specialty_id,
        ]);


        return redirect('service')->with('mensaje','Servicio Agregado con Éxito');
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
        $service=Service::findOrFail($id);
        $specialty = Specialty::all();
        return view('service.edit',compact ('service','specialty'));
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
        //
        $campos = [
        'name' => ['required', 'string', 'max:255'],
        'specialty_id'=>'required|integer',
        ];
        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);
        $dataService=request()->except(['_token','_method']);
        Service::where('id','=',$id)->update($dataService);
        return redirect('service')->with('mensaje','Servicio Modificado con Éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect('service')->with('mensaje','Especialidad Eliminada con Éxito');
    }
}
