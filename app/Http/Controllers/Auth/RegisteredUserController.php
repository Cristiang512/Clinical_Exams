<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rol;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        // $request['rol_id'] = 1;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'document' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'rol_id'=> ['integer', 'max:255'],
        ]);
        // $user['rol_id'] = 1;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'document' => $request->document,
            'password' => Hash::make($request->password),
            'rol_id' => 1,
        ]);

        // $request = User::insertGetId([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'document' => $request['document'],
        //     'password' => Hash::make($request['password']),
        //     'rol_id' => 1
        // ], 'id');
        // $user['rol_id'] = 1;

        // return $user;
        event(new Registered($user));

        // Auth::login($user);
        // return $user;

        return redirect(RouteServiceProvider::ADMIN)->with('mensaje','Administrador Agregado con Éxito');
    }
}
