<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Models\Mensaje;
use App\Models\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class MensajesControllerV2 extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index','show','edit','update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mensajes = Mensaje::with('usuario','notas')->get();

        return view('mensajes.index',compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        if (auth()->check())
        {
            $data = array_merge($data,[
                'nombre' => auth()->user()->name,
                'correo' => auth()->user()->email
            ]);

            $message = auth()->user()->mensajes()->create($data);

        }else{
            $message = Mensaje::create($data);
        }

        Mail::send('emails.contact',['mensaje' => $message],function ($m) use($message){
            $m->to($message->email, $message->name)->subject('tu mensaje fue recibido');
        });

        return redirect()->route('mensajes.create')
            ->with('info','tu mensaje fue enviado correctamente :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show(Mensaje $mensaje)
    {
        //

        return view('mensajes.show',compact('mensaje'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensaje $mensaje)
    {
        //

        $tags = Tag::all();

        return view('mensajes.formulario',compact('mensaje','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensaje $mensaje)
    {
        //
        $data = $request->except('_token','_method');

        $mensaje->update($data);

        return redirect()->route('mensajes.index')
            ->with('info','el mensaje fue editado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje)
    {
        //
        $mensaje->delete();

        return redirect()->route('mensajes.index')
            ->with('info','el mensaje fue eliminado correctamente :)');
    }
}
