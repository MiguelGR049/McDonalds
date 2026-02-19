<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login()
    {
        $sesionUsuario = session('sesionUsuario');
        if ($sesionUsuario == "") {
            return view("pages.login", ["titulo" => "login"]);
        } else {
            return redirect()->route("inicio");
        }
    }

    public function login_usuario(Request $request)
    {

        $request->validate([
            "usuario" => "required|string|regex:/^[A-Za-z0-9]+$/",
            "password" => "required|string"
        ]);

        $consulta = Usuario::where("usuario", $request->usuario)->first();

        if ($consulta) {

            if (password_verify($request->password, $consulta->password)) {

                session()->put("sesionUsuario", $consulta->id);
                session()->put("rol", $consulta->roles);

                return redirect()->route("inicio");
            } else {
                throw ValidationException::withMessages([
                    "password" => "Contraseña incorrecta"
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                "usuario" => "Usuario no encontrado"
            ]);
        }
    }


    public function cerrar_sesion(Request $request)
    {
        $request->session()->forget("sesionUsuario");
        $request->session()->forget("id");
        return redirect()->route("login");
    }
}
