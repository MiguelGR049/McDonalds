<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mcdonals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create("usuario", function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 250);
            $table->string("apellido", 250);
            $table->string("usuario", 250)->unique();
            $table->string("email", 250);
            $table->text("password");
            $table->timestamps();
        });

        Schema::create("pedidos", function (Blueprint $table) {
            $table->id();
            $table->string("tipo", 250);
            $table->text("descripcion");
            $table->string("total_pagar", 250);
            $table->string("metodo_pago", 250);
            $table->string("entregado", 250);
            $table->text("fecha_pedido");
            $table->boolean("impreso")->default(false);

            $table->foreignId("usuario_id")
                ->constrained("usuario")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
