<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;

class PagesController extends Controller
{

    public function __construct()
    {
        //$this->middleware('example',['only' => ['home']]);
    }

    //
    public function home()
    {
        return view('index');
    }

    public function saludo($nombre = 'invitado')
    {
        $consolas = [
            'play station',
            'x box',
            'nintendo switch',
        ];

        return view('saludo', compact('nombre', 'consolas'));
    }
}
