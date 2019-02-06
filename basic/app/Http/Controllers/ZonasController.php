<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Role;
use App\Models\Zona;
use Illuminate\Http\Request;

class ZonasController extends Controller
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
        //
        $zonas = Zona::all();

        return view('zonas.index',compact('zonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('zonas.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'entidad' => 'required|string|in:roles,perfiles',
            'identificador' => 'required|numeric|exists:'.$request->input('entidad').',id',
            'key' => 'required|string|min:1',
            'name' => 'required|string|min:5',

        ],[
            'entidad.required' => 'el tipo de entidad es obligatorio',
            'entidad.in' => 'el tipo de entidad no es válido',
            'identificador.exists' => 'el identificador no es válido',
            'identificador.required' => 'el identificador es obligatorio',
            'key.required' => 'la llave es obligatoria',
            'key.min' => 'la llave tiene q ser mas larga.',
            'name.required' => 'el nombre es obligatorio',
            'name.min' => 'el nombre tiene q ser mas largo.'
        ]);

        if ($request->input('entidad') === 'perfiles')
        {
            $entidad = Perfil::findOrFail($request->input('identificador'));
        }else{
            $entidad = Role::findOrFail($request->input('identificador'));
        }

        $entidad->zonas()->create($request->only('key','name'));

        return redirect()->route('zonas.index')->with('info','zona creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        //
        return view('zonas.show',compact('zona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit(Zona $zona)
    {
        //
        return view('zonas.formulario',compact('zona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zona $zona)
    {
        //
        $data = $request->only('key','name');

        $zona->update($data);

        return redirect()->route('zonas.index')
            ->with('info','la zona fue editado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zona $zona)
    {
        //
        try{
            $zona->delete();

            return redirect()->route('zonas.index')
                ->with('info','la zona fue eliminado correctamente :)');

        }catch (\Exception $e){

            return back()->with('error',$e->getCode().' '.$e->getMessage());
        }
    }
}
