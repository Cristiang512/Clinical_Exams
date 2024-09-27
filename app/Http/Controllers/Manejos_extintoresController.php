<?php

namespace App\Http\Controllers;

use App\Models\Manejos_extintores;
use App\Models\User;
use App\Models\Service;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class Manejos_extintoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $datos['cliente']=User::where('id','=',$id)->get();
        $datos['manejoext'] = Manejos_extintores::leftJoin('especialidad', 'especialidad.id', '=', 'resultado.specialty_id')
        ->leftJoin('servicio', 'servicio.id', '=', 'resultado.service_id')
        ->select(
        'resultado.resultado_id',
        'resultado.document',
        'resultado.fecha_subida',
        'especialidad.name AS specialty',
        'servicio.name AS service'
        )
        ->where('user_id','=',$id)
        ->get();

        $datos['user_id']=$id;
        $specialty = Specialty::all();
        $service = Service::all();
        return view('patient.extintores', $datos, compact('specialty', 'service'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $archivo=$request->file('document');
        // if(file_exists('../public/Archivos/'.$archivo->getClientOriginalName())){
        //     return redirect()->route('cliente_extintor',['id'=>$request->user_id])->with('mensaje','Ya existe un Documento con este Nombre');
        // }
        $stringRandom = Str::random(3);
        $nameFile = $archivo->getClientOriginalName();
        $s1 = explode(".",$nameFile);
        $s2 = $s1[0]."-".$stringRandom.".".$s1[1];
        try{
            DB::beginTransaction();
            $now = new \DateTime();
            $registro = new Manejos_extintores;
            $registro->fecha_subida=$now->format('Y-m-d');
            $registro->user_id=$request->user_id;
            $registro->specialty_id=$request->specialty_id;
            $registro->service_id=$request->service_id;
            if($request->hasFile('document')){
                $archivo=$request->file('document');
                $archivo->move(public_path().'/Archivos/',$s2);
                $registro->document=$s2;
            }
            $registro->save();
                DB::commit();
        } catch (Exception $e) {
                DB::rollBack();
        }

        return redirect()->route('cliente_extintor',['id'=>$registro['user_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        //
    }

    public function ocultar($id)
    {       
        $file = Manejos_extintores::where('resultado_id',$id)->select('document')->get();
        $file_exist = '../public/Archivos/'.$file[0]['document'];
        if($file_exist){
            Manejos_extintores::where('resultado_id',$id)->delete();
            @unlink($file_exist);
            return redirect()->back();
        }else{
            return back()->with(["error"=>"File not found!"]);
        }
    }

}

