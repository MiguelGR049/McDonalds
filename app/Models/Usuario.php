<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'usuario';

    public function pedidos(){
        return $this->hasMany(Pedidos::class, 'usuario_id');
    }

    public function esGerente(){
        return $this->roles === 'gerente';
    }
}
