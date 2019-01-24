<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MensajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mensajes = DB::table('mensajes')->get();

        return view('mensajes.index',compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('mensajes.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        $data = $request->except('_token');
        $data = json_decode(json_encode($data));

        DB::table('mensajes')->insert([
            'nombre' => $data->nombre,
            'correo' => $data->correo,
            'telefono' => $data->telefono,
            'mensaje' => $data->mensaje,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('mensajes.index')
            ->with('info','tu mensaje fue enviado correctamente :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $mensaje)
    {
        //
        $mensaje = DB::table('mensajes')->find($mensaje);

        return view('mensajes.show',compact('mensaje'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $mensaje)
    {
        //
        $mensaje = DB::table('mensajes')->find($mensaje);
        return view('mensajes.formulario',compact('mensaje'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMessageRequest $request, int $mensaje)
    {
        //
        $data = $request->except('_token','_method');
        $data = json_decode(json_encode($data));

        DB::table('mensajes')->where('id',$mensaje)->update([
            'nombre' => $data->nombre,
            'correo' => $data->email,
            'telefono' => $data->telefono,
            'mensaje' => $data->mensaje,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('mensajes.index')
            ->with('info','el mensaje fue editado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $mensaje)
    {
        DB::table('mensajes')->delete($mensaje);

        return redirect()->route('mensajes.index')
            ->with('info','el mensaje fue eliminado correctamente :)');
    }
}
