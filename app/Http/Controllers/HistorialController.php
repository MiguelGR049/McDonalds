<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Usuario;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function historial()
    {
        $idUsuario = session('sesionUsuario');

        if (!$idUsuario) {
            return view("pages.login", ["titulo" => "login"]);
        }

        $usuario = Usuario::find($idUsuario);

        if (!$usuario) {
            session()->forget('sesionUsuario');
            return view("pages.login", ["titulo" => "login"]);
        }

        if ($usuario->roles === 'gerente') {

            $datos = Pedidos::with('usuario')
                ->where('entregado', 'Si')
                ->get();

        } else {

            $datos = Pedidos::with('usuario')
                ->where('entregado', 'Si')
                ->where('usuario_id', $idUsuario)
                ->get();
        }

        return view("pages.historial", [
            "titulo" => "Pedidos Entregados",
            "datos" => $datos
        ]);
    }
}
