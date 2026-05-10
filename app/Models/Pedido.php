<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'productos',
        'estado',
        'user_id'
    ];

    public function productos(){
        return $this->belongsToMany(Producto::class, 'pedido_producto');
    }
}