<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegistroController extends Controller{
    public function registro(){
        $sesionUsuario = session('sesionUsuario');
        if($sesionUsuario == ""){
            return view("pages.registro",["titulo"=>"Registro"]);
        }else{
            return view("pages.inicio",["titulo"=>"Inicio"]);
        }
    }
    
    public function insertar_usuario(Request $request, Usuario $usuario){
        request()->validate([
            "nombre"=> "required|string|regex:/^[A-Z]{1}[a-z]+$/",
            "apellido"=> "required|string|regex:/^[A-Z]{1}[a-z]+$/",
            "usuario"=> "required|string|regex:/^[A-Za-z0-9]+$/",
            "email"=> "required|string|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z]{2,}$/i",
            "password"=> "required|string|regex:/^\d{4}$/"
        ],
        [
            "nombre.regex"=>"El nombre solo puede contener letras y debe empezar con mayúscula",
            "nombre.required"=>"El nombre es obligatorio",
            "apellido.regex"=>"El apellido solo puede contener letras y debe empezar con mayúscula",
            "apellido.required"=> "El apellido es obligatorio",
            "usuario.regex"=> "El usuario solo puede contener letras y números",
            "usuario.required"=> "El usuario es obligatorio",
            "email.regex"=> "El email no es válido",
            "email.required"=> "El email es obligatorio",
            "password.required"=> "El PIN es obligatoria",
            "password.regex"=> "El PIN solo puede contener números y debe tener al menos 4 dígitos"
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        try{
            $usuario->save();
            return redirect()->route("login");
        }catch(Exception $e){
            throw ValidationException::withMessages(["usuario"=> "Ese usuario ya esta registrado"]);
        }
    }
}
