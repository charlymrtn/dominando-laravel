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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsNota  $modelsNota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        //
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
    }
}
