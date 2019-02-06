<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\User;

class TagsController extends Controller
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
        //
        $tags = Tag::all();

        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tags.formulario');
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
            'entidad' => 'required|string|in:mensajes,users',
            'identificador' => 'required|numeric|exists:'.$request->input('entidad').',id',
            'name' => 'required|string|min:3'

        ],[
            'entidad.required' => 'el tipo de entidad es obligatorio',
            'entidad.in' => 'el tipo de entidad no es válido',
            'identificador.exists' => 'el identificador no es válido',
            'identificador.required' => 'el identificador es obligatorio',
            'name.required' => 'el nombre es obligatorio',
            'name.min' => 'el nombre tiene q ser mas largo.'
        ]);

        if ($request->input('entidad') === 'mensajes')
        {
            $entidad = Mensaje::findOrFail($request->input('identificador'));
        }else{
            $entidad = User::findOrFail($request->input('identificador'));
        }

        $entidad->tags()->create($request->only('name'));

        return redirect()->route('etiquetas.index')->with('info','etiqueta creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(int $tag)
    {
        //
        $tag = Tag::find($tag);
        return view('tags.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(int $tag)
    {
        //
        $tag = Tag::find($tag);
        return view('tags.formulario',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $tag)
    {
        //
        $data = $request->only('name');

        Tag::find($tag)->update($data);

        return redirect()->route('etiquetas.index')
            ->with('info','la etiqueta fue editada correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $tag)
    {
        //
        try{
            Tag::find($tag)->delete();

            return redirect()->route('etiquetas.index')
                ->with('info','la etiqueta fue eliminado correctamente :)');

        }catch (\Exception $e){

            return back()->with('error',$e->getCode().' '.$e->getMessage());
        }
    }
}
