<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PedidosController extends Controller
{
    public function inicio()
    {
        $sesionUsuario = session('sesionUsuario');

        if ($sesionUsuario == "") {
            return view("pages.login", ["titulo" => "login"]);
        } else {
            return view("pages.inicio", ["titulo" => "Inicio"]);
        }
    }

    public function lista_pedidos()
    {
        $sesionUsuario = session('sesionUsuario');

        if ($sesionUsuario == "") {
            return view("pages.login", ["titulo" => "login"]);
        } else {
            $consulta = Pedidos::get();
            $datos = $consulta;
            return view("pages.pedidos", ["titulo" => "Pedidos", "datos" => $datos]);
        }
    }
    public function agregar()
    {
        $sesionUsuario = session('sesionUsuario');

        if ($sesionUsuario == "") {
            return view("pages.login", ["titulo" => "login"]);
        } else {
            return view("pages.agregar", ["titulo" => "Agregar"]);
        }
    }
    public function editar(Request $request)
    {
        $sesionUsuario = session('sesionUsuario');

        if ($sesionUsuario == "") {
            return view("pages.login", ["titulo" => "login"]);
        } else {
            $consulta = Pedidos::where("id", $request->id)->first();
            return view("pages.editar", ["titulo" => "Editar Pedido", "pedido" => $consulta]);
        }
    }

    public function actualizar(Request $request, Pedidos $pedido)
    {
        request()->validate(
            [
                "tipo" => "required|string",
                "descripcion" => "required|string",
                "total_pagar" => "required|string",
                "metodo_pago" => "required|string"
            ],
            [
                "tipo.required" => "El tipo es obligatorio",
                "descripcion.required" => "La descripcion es obligatoria",
                "total_pagar.required" => "El total a pagar es obligatorio",
                "metodo_pago.required" => "El metodo de pago es obligatorio"
            ]
        );
        $pedido->tipo = $request->tipo;
        $pedido->descripcion = $request->descripcion;
        $pedido->total_pagar = $request->total_pagar;
        $pedido->metodo_pago = $request->metodo_pago;
        $pedido->save();
        return redirect()->route("lista_pedidos");
    }

    public function actualizarEntregado(Request $request, $id)
    {
        $pedido = Pedidos::findOrFail($id);
        $pedido->entregado = $request->entregado;
        $pedido->save();

        return response()->json(['success' => true]);
    }

    public function marcarImpreso($id)
    {
        $pedido = Pedidos::findOrFail($id);
        $pedido->impreso = true;
        $pedido->save();

        return response()->json(['success' => true]);
    }


    public function insertar_pedido(Request $request, Pedidos $pedido)
    {
        request()->validate(
            [
                "tipo" => "required|string",
                "descripcion" => "required|string",
                "total_pagar" => "required|string",
                "metodo_pago" => "required|string",
                "entregado" => "required|string"
            ],
            [
                "tipo.required" => "El tipo es obligatorio",
                "descripcion.required" => "La descripcion es obligatoria",
                "total_pagar.required" => "El total a pagar es obligatorio",
                "metodo_pago.required" => "El metodo de pago es obligatorio",
                "entregado.required" => "El estado de entrega es obligatorio"
            ]
        );
        $pedido->tipo = $request->tipo;
        $pedido->descripcion = $request->descripcion;
        $pedido->total_pagar = $request->total_pagar;
        $pedido->metodo_pago = $request->metodo_pago;
        $pedido->entregado = $request->entregado;
        $pedido->fecha_pedido = $request->fecha_pedido;
        $pedido->save();
        return redirect()->route("lista_pedidos");
    }
    public function eliminar_pedido(Request $request, Pedidos $pedido)
    {
        $pedido = Pedidos::where("id", $request->id)->first();
        $pedido->delete();
        return redirect()->route("lista_pedidos");
    }
}
