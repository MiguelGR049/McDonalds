<?php

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login_usuario', [LoginController::class, 'login_usuario'])->name('login_usuario');
Route::get('/cerrar_sesion', [loginController::class, 'cerrar_sesion'])->name('cerrar_sesion');

Route::get('/registro', [RegistroController::class, 'registro'])->name('registro');
Route::post('/insertar_usuario', [RegistroController::class, 'insertar_usuario'])->name('insertar_usuario');

Route::get('/', [PedidosController::class, 'inicio'])->name('inicio');
Route::get('/inicio', [PedidosController::class, 'inicio'])->name('inicio');

Route::get('/lista', [PedidosController::class, 'lista_pedidos'])->name('lista_pedidos');
Route::get('/agregar', [PedidosController::class, 'agregar'])->name('agregar');
Route::post('/pedidos/actualizar-entregado/{id}', [PedidosController::class, 'actualizarEntregado']);
Route::post('/pedidos/marcar-impreso/{id}', [PedidosController::class, 'marcarImpreso']);

Route::get('/historial', [HistorialController::class, 'historial'])->name('historial');

Route::get('/editar/{id}', [PedidosController::class, 'editar'])->name('editar');
Route::put('/edicion/{pedido}', [PedidosController::class, 'actualizar'])->name('actualizar');
Route::post('/insertar', [PedidosController::class, 'insertar_pedido'])->name('insertar');
Route::get('/eliminar/{id}', [PedidosController::class, 'eliminar_pedido'])->name('eliminar');
