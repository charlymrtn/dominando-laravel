<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Nota;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotasController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','check.role:admin'])->only('index','show','edit','update');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::all();

        return view('notas.index',compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('notas.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'entidad' => 'required|string|in:mensajes,users',
            'identificador' => 'required|numeric|exists:'.$request->input('entidad').',id',
            'body' => 'required|string|min:5'

        ],[
            'entidad.required' => 'el tipo de entidad es obligatorio',
            'entidad.in' => 'el tipo de entidad no es válido',
            'identificador.exists' => 'el identificador no es válido',
            'identificador.required' => 'el identificador es obligatorio',
            'body.required' => 'el texto es obligatorio',
            'body.min' => 'el texto tiene q ser mas largo.'
        ]);

        if ($request->input('entidad') === 'mensajes')
        {
            $entidad = Mensaje::findOrFail($request->input('identificador'));
        }else{
            $entidad = User::findOrFail($request->input('identificador'));
        }

        $entidad->notas()->create($request->only('body'));

        return redirect()->route('notas.index')->with('info','nota creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsNota  $modelsNota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        //
        return view('notas.show',compact('nota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsNota  $modelsNota
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        //
        return view('notas.formulario',compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsNota  $modelsNota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        //
        $data = $request->only('body');

        $nota->update($data);

        return redirect()->route('notas.index')
            ->with('info','la nota fue editado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsNota  $modelsNota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        //
        try{
            $nota->delete();

            return redirect()->route('notas.index')
                ->with('info','la nota fue eliminado correctamente :)');

        }catch (\Exception $e){

            return back()->with('error',$e->getCode().' '.$e->getMessage());
        }
    }

    //attach

    public function attach(Request $request, int $id)
    {
        //
        $request->merge([
            'identifier' => $id
        ]);
        $validator = Validator::make($request->all(),
            [
                'body' => 'required|string|min:5',
                'model' => 'required|string|in:mensajes,users',
                'identifier' => 'required|numeric|exists:'.$request->input('model').',id'
            ],
            [
                'body.required' => 'el texto de la nota es requerido',
                'model.required' => 'el modelo es requerido',
                'model.in' => 'el modelo no es válido',
                'body.min' => 'el texto es muy corto, pon un poco más',
                'identifier.required' => 'el id es obligatorio',
                'identifier.exists' => 'el id no existe',
            ]
        );

        if ($validator->fails())
        {
            return back()->withErrors($validator->errors());
        }

        if ($request->input('model')) $modelo = $request->input('model');

        if($modelo === 'mensajes')
        {
            $entidad = Mensaje::findOrFail($id);
        }elseif ($modelo === 'users'){
            $entidad = User::findOrFail ($id);
        }

        $entidad->notas()->create($request->only('body'));

        return redirect()->route($modelo === 'mensajes'?'mensajes.edit':'usuarios.edit',$entidad->id)->with('info','nota agregada correctamente');
    }
}
