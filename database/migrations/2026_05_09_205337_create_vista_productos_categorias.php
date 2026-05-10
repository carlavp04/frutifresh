<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW vista_productos_categorias AS

            SELECT
                productos.nombre AS producto,
                categorias.nombre AS categoria

            FROM productos

            JOIN categoria_producto
                ON productos.id = categoria_producto.producto_id

            JOIN categorias
                ON categorias.id = categoria_producto.categoria_id
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_productos_categorias");
    }
};