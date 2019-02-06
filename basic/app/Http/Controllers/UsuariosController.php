<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Perfil;
use App\Models\Role;
use App\Models\Tag;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class UsuariosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','check.role:A'])->only('index','show','edit','update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::with('role','perfiles','notas')->get();

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
        $perfiles = Perfil::pluck('name','id');

        return view('usuarios.formulario',compact('roles','perfiles'));
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

        $usuario = User::create($data);

        foreach ($data['perfiles'] as $perfil)
        {
            $usuario->perfiles()->attach($perfil);
        }

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
            $tags = Tag::all();

            $perfiles = Perfil::pluck('name','id');

            return view('usuarios.formulario',compact('usuario','roles','perfiles','tags'));
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
        try{
            $this->authorize($usuario);

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
                'role_id' => 'required|integer|exists:roles,id',
                'perfiles' => 'required|array|min:1|exists:perfiles,id'
            ],[
                'email.required' => 'el campo correo es awebo',
                'email.unique' => 'ese correo ya esta en uso.',
                'name.required' => 'el nombre es obligatorio',
                'role_id.required' => 'el rol es awebo',
                'role_id.exists' => 'el rol no existe',
                'perfiles.required' => 'los perfiles son necesarios.',
                'perfiles.min' => 'mínimo es un perfil.',
                'perfiles.exists' => 'ese perfil no esta registrado'
            ]);

            if ($validator->fails()){

                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = $request->except('_token','_method');

            $usuario->update($data);
            $usuario->perfiles()->sync($data['perfiles']);
            //$usuario->perfiles()->detach();
            //
            //foreach ($data['perfiles'] as $perfil)
            //{
            //    $usuario->perfiles()->attach($perfil);
            //}

            return redirect()->route('usuarios.index')
                ->with('info','el usuario fue editado correctamente :)');

        }catch(AuthorizationException $e){
            return redirect()->route('usuarios.show',$usuario->id)->with('error',$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        try {
            //$this->authorize($usuario);

            if (auth()->user()->isAdmin()){
                $usuario->perfiles()->detach();
                $usuario->delete();
                return redirect()->route('usuarios.index')
                    ->with('info','el usuario fue eliminado correctamente :)');
            }else{
                return redirect()->route('usuarios.index')->with('error','solo los administradores pueden eliminar usuarios');
            }

        } catch (QueryException $e) {
            if($e->getCode() == '23000'){
                return back()->with('error','imposible borrar el usuario ya que tiene dependencias con perfiles');
            }

            return back()->with('error',$e->getMessage().' '.$e->getMessage());
        }

    }
}
