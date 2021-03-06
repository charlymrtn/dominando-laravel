<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PerfilesController extends Controller
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
        $perfiles = Perfil::all();

        return view('perfiles.index',compact('perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perfiles.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        //
        $data = $request->except('_token');

        Perfil::create($data);

        return redirect()->route('perfiles.index')
            ->with('info','el perfil fue creado correctamente :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
        return view('perfiles.show',compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
        return view('perfiles.formulario',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //
        $data = $request->except('_token','_method');

        $perfil->update($data);

        return redirect()->route('perfiles.index')
            ->with('info','el perfil fue editado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
        try{
            $perfil->delete();

            return redirect()->route('perfiles.index')
                ->with('info','el perfil fue eliminado correctamente :)');

        }catch (QueryException $e){
            if($e->getCode() == '23000'){
                return back()->with('error','imposible borrar el perfil debido a que hay usuarios que pertenecen a este perfil');
            }

            return back()->with('error',$e->getMessage().' '.$e->getMessage());
        }

    }
}
