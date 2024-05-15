<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;

class RegistroExalumnosController extends Controller
{
    protected $guard;

    public function store(Request $request)
    {
        //dd($request->all());
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create($request->all());
        $user->roles()->attach(5);
        $user->save();
        $this->guard->login($user);
    
        return redirect()->route('users.index')->with('status', __('Usuario Creado Exitosamente'));
    }

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function create(){
        return view('auth.registro-exalumnos');
    }
}
