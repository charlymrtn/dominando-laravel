<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Role;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','check.role:admin'])->only('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();

        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.formulario',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->except('_token');

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);

        return redirect()->route('usuarios.index')
            ->with('info','el usuario fue creado correctamente :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        //
        return view('usuarios.show',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        try {
            $this->authorize($usuario);
            $roles = Role::all();

            return view('usuarios.formulario',compact('usuario','roles'));
        } catch (AuthorizationException $e) {
            return redirect()->route('usuarios.index')->with('error',$e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            //'email' => [
            //    'required',
            //    'string',
            //    'email',
            //    'max:255',
            //    Rule::unique('users')->ignore($usuario->id)
            //],
            'email' => 'required|string|email|max:255|unique:users,email,'.$usuario->id,
            'role_id' => 'required|integer|exists:roles,id'
        ],[
            'email.required' => 'el campo correo es awebo',
            'email.unique' => 'ese correo ya esta en uso.',
            'name.required' => 'el nombre es obligatorio',
            'role_id.required' => 'el rol es awebo',
            'role_id.exists' => 'el rol no existe'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->except('_token','_method');

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('info','el usuario fue editado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('info','el usuario fue eliminado correctamente :)');
    }
}
