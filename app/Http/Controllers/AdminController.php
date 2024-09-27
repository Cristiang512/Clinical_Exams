<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['admin']=User::where('rol_id','=','1')->get();

        return view('admin.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
        'document' => ['required', 'string', 'max:255', 'unique:users'],
        'phone' => ['string', 'max:255'],
        'email' => ['string', 'max:255'],
        ];

        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);
        $dataAdmin=request()->except('_token');

        $dataAdmin = User::create([
            'name' => $request->name,
            'document' => $request->document,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make(substr($request->document, -4)),
            'rol_id' => 1,
        ]);

        return redirect('admin')->with('mensaje','Administrador Agregado con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
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
        //
        $admin=User::findOrFail($id);
        return view('admin.edit',compact ('admin'));
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
        'document' => ['required', 'string', 'max:255'],
        ];
        $mensaje=["required" => ' :attribute es requerido'];

        $this ->validate ($request,$campos,$mensaje);
        $dataAdmin=request()->except(['_token','_method']);

        User::where('id','=',$id)->update($dataAdmin);

        return redirect('admin')->with('mensaje','Administrador Modificado con Éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('admin')->with('mensaje','Administrador Eliminado con Éxito');
    }
}
