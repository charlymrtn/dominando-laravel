<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Perfil;
use App\Models\Role;
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

    public function roles(): JsonResponse
    {
        $roles = Role::all();

        return response()->json($roles);
    }

    public function perfiles(): JsonResponse
    {
        $perfiles = Perfil::all();

        return response()->json($perfiles);
    }
}
