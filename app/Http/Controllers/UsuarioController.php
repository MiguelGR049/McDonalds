<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function lista_Usuarios()
    {
        $sesionUsuario = session('sesionUsuario');

        if ($sesionUsuario == "") {
            return view("pages.login", ["titulo" => "login"]);
        } else {
            $consulta = Usuario::get();
            $datos = $consulta;
            return view("pages.empleados", ["titulo" => "Empleados", "datos" => $datos]);
        }
    }
}
