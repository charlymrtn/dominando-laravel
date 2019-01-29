<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function mensajes(): JsonResponse
    {
        $mensajes = Mensaje::all();

        return response()->json($mensajes);
    }

    public function users(): JsonResponse
    {
        $usuarios = User::all();

        return response()->json($usuarios);
    }
}
