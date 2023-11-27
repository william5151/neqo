<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'numero_identificacion' => ['required', 'string', 'unique:users','regex:/^[0-9]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'numeric', 'digits:4',  'confirmed' ],
            
        ],[
            
        'required' => 'El campo :attribute es obligatorio.',
        'string' => 'El campo :attribute debe ser una cadena de caracteres.',
        'max' => [
            'string' => 'El campo :attribute no puede tener más de :max caracteres.',
        ],
        'numero_identificacion.regex' => 'El campo Número de Identificación debe contener solo números.',
        'unique' => 'El :attribute ya ha sido registrado.',
        'email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
        'password.numeric' => 'La contraseña debe ser numérica.',
        'password.digits' => 'La contraseña debe tener exactamente :digits dígitos.',
        'password.confirmed' => 'La confirmación de la contraseña no coincide.',
    ]);
}
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    { 
        return User::create([
            'name' => $data['name'],
            'numero_identificacion' => $data['numero_identificacion'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            
        ]);
    
    }
}
