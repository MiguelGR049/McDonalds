<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegistroController extends Controller
{
    public function registro()
    {
        $sesionUsuario = session('sesionUsuario');
        if ($sesionUsuario == "") {
            return view("pages.registro", ["titulo" => "Registro"]);
        } else {
            return view("pages.inicio", ["titulo" => "Inicio"]);
        }
    }

    public function registro_empleado()
    {
        $idUsuario = session('sesionUsuario');
        $usuario = Usuario::find($idUsuario);

        if ($usuario->roles == 'gerente') {
            return view("pages.registroEmpleado", ["titulo" => "Registro"]);
        } else {
            return view("pages.inicio", ["titulo" => "Inicio"]);
        }
    }

    public function insertar_usuario(Request $request, Usuario $usuario)
    {
        request()->validate(
            [
                "nombre" => "required|string|regex:/^[A-Z]{1}[a-z]+$/",
                "apellido_pa" => "required|string|regex:/^[A-Z]{1}[a-z]+$/",
                "apellido_ma" => "required|string|regex:/^[A-Z]{1}[a-z]+$/",
                "usuario" => "required|string|regex:/^[A-Za-z0-9]+$/",
                "email" => "required|string|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z]{2,}$/i",
                "password" => "required|string|regex:/^\d{4}$/"
            ],
            [
                "nombre.regex" => "El nombre solo puede contener letras y debe empezar con mayúscula",
                "nombre.required" => "El nombre es obligatorio",
                "apellido_pa.regex" => "El apellido paterno solo puede contener letras y debe empezar con mayúscula",
                "apellido_pa.required" => "El apellido paterno es obligatorio",
                "apellido_ma.regex" => "El apellido materno solo puede contener letras y debe empezar con mayúscula",
                "apellido_ma.required" => "El apellido materno es obligatorio",
                "usuario.regex" => "El usuario solo puede contener letras y números",
                "usuario.required" => "El usuario es obligatorio",
                "email.regex" => "El email no es válido",
                "email.required" => "El email es obligatorio",
                "password.required" => "El PIN es obligatoria",
                "password.regex" => "El PIN solo puede contener números y debe tener al menos 4 dígitos"
            ]
        );

        $usuario->nombre = $request->nombre;
        $usuario->apellido_pa = $request->apellido_pa;
        $usuario->apellido_ma = $request->apellido_ma;
        $usuario->usuario = $request->usuario;
        $usuario->roles = 'cliente';
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        try {
            $usuario->save();
            return redirect()->route("login");
        } catch (Exception $e) {
            throw ValidationException::withMessages(["usuario" => "Ese usuario ya esta registrado"]);
        }
    }

    public function insertar_empleado(Request $request, Usuario $usuario)
    {
        request()->validate(
            [
                "nombre" => "required|string|regex:/^[A-Z]{1}[a-z]+$/",
                "apellido_pa" => "required|string|regex:/^[A-Z]{1}[a-z]+$/",
                "apellido_ma" => "required|string|regex:/^[A-Z]{1}[a-z]+$/",
                "usuario" => "required|string|regex:/^[A-Za-z0-9]+$/",
                "roles" => "required|in:cajero,gerente",
                "email" => "required|string|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z]{2,}$/i",
                "password" => "required|string|regex:/^\d{4}$/"
            ],
            [
                "nombre.regex" => "El nombre solo puede contener letras y debe empezar con mayúscula",
                "nombre.required" => "El nombre es obligatorio",
                "apellido_pa.regex" => "El apellido paterno solo puede contener letras y debe empezar con mayúscula",
                "apellido_pa.required" => "El apellido paterno es obligatorio",
                "apellido_ma.regex" => "El apellido materno solo puede contener letras y debe empezar con mayúscula",
                "apellido_ma.required" => "El apellido materno es obligatorio",
                "usuario.regex" => "El usuario solo puede contener letras y números",
                "usuario.required" => "El usuario es obligatorio",
                "usuario.roles.required" => "El puesto es obligatorio",
                "email.regex" => "El email no es válido",
                "email.required" => "El email es obligatorio",
                "password.required" => "El PIN es obligatoria",
                "password.regex" => "El PIN solo puede contener números y debe tener al menos 4 dígitos"
            ]
        );

        $usuario->nombre = $request->nombre;
        $usuario->apellido_pa = $request->apellido_pa;
        $usuario->apellido_ma = $request->apellido_ma;
        $usuario->usuario = $request->usuario;
        $usuario->roles = $request->roles;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        try {
            $usuario->save();
            return redirect()->route("inicio");
        } catch (Exception $e) {
            throw ValidationException::withMessages(["usuario" => "Ese usuario ya esta registrado"]);
        }
    }
}
