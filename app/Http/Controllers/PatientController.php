<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use PhpParser\Node\Stmt\TryCatch;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['patient']=User::where('rol_id','=','2')->get();

        return view('patient.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
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

        $dataPatient=request()->except('_token');

        $dataPatient = User::create([
            'name' => $request->name,
            'document' => $request->document,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make(substr($request->document, -4)),
            'rol_id' => 2,
        ]);

        return redirect('patient')->with('mensaje','Paciente Agregado con Éxito');
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
        //
        $patient=User::findOrFail($id);
        return view('patient.edit',compact ('patient'));
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

        if($request["password"]){
            $campos = [
                'name' => ['required', 'string', 'max:255'],
                'document' => ['required', 'string', 'max:255'],
                'phone' => ['required','string', 'max:255'],
                'email' => ['string', 'max:255'],
            ];
            User::where('id','=',$id)->update([
                'name' => $request->name,
                'document' => $request->document,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make(substr($request->document, -4))
            ]);

        } else {
            $campos = [
                'name' => ['required', 'string', 'max:255'],
                'document' => ['required', 'string', 'max:255'],
                'phone' => ['required','string', 'max:255'],
                'email' => ['string', 'max:255'],
            ];
            $dataPatient=request()->except(['_token','_method']);
            User::where('id','=',$id)->update($dataPatient);
        }

        return redirect('patient')->with('mensaje','Paciente Modificado con Éxito');
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
        return redirect('patient')->with('mensaje','Paciente Eliminado con Éxito');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        $csv = str_getcsv($file);
        return $file;
        Excel::import(new UsersImport, $file);

        return back()->with('message', 'Importanción de usuarios completada');
    }

    



    public function importExcelTest(Request $request)
    {
        $file = $request->file('file');

        function csvtoarray($archivo,$delimitador = ";"){

            if(!empty($archivo) && !empty($delimitador) && is_file($archivo)):
        
                $array_total = array();
        
                $fp = fopen($archivo,"r");
        
                while ($data = fgetcsv($fp, 10000, $delimitador)){
        
                    $num = count($data);
        
                    $array_total[] = array_map("utf8_encode",$data);
        
                }
        
                fclose($fp);
        
                return $array_total;
        
            else:
        
                return false;
        
            endif;
        
        }

        $arraycsv = csvtoarray($file);

        foreach( $arraycsv AS $row ) {
            User::insertOrIgnore([
                'name'     => $row[0], //a
                    'document'    => $row[1], //b
                    'phone'    => $row[2], //c
                    'email'    => $row[3], //d
                    'password' => bcrypt(substr($row[1], -4)), //e
                    'rol_id'    => 2, //f
                ]);
        }
        return back()->with('message', 'Importanción de usuarios completada');

    }

    public function changePassword()
    {
        return view('patient.change-password');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/patient/'.auth()->user()->id.'/index')->with("status", "Cambio de Contraseña Exitoso!");
    }
}
