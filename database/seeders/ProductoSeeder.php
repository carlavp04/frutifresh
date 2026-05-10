<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // CATEGORÍAS

        $frutas = Categoria::create([
            'nombre' => 'Frutas'
        ]);

        $detox = Categoria::create([
            'nombre' => 'Detox'
        ]);

        $tropical = Categoria::create([
            'nombre' => 'Tropical'
        ]);

        $smoothie = Categoria::create([
            'nombre' => 'Smoothie'
        ]);

        $saludable = Categoria::create([
            'nombre' => 'Saludable'
        ]);

        $energetico = Categoria::create([
            'nombre' => 'Energético'
        ]);
        
        $vegetales = Categoria::create([
            'nombre' => 'Vegetales'
        ]);

        // PRODUCTOS

        $naranja = Producto::create([
            'nombre' => 'Zumo de naranja',
            'descripcion' => 'Zumo natural recién exprimido',
            'precio' => 3.50,
            'stock' => 10
        ]);

        $detoxProducto = Producto::create([
            'nombre' => 'Zumo detox',
            'descripcion' => 'Zumo saludable detox',
            'precio' => 4.00,
            'stock' => 8
        ]);

        $tropicalProducto = Producto::create([
            'nombre' => 'Zumo tropical',
            'descripcion' => 'Zumo tropical refrescante',
            'precio' => 4.50,
            'stock' => 6
        ]);

        //  NUEVOS ZUMOS

        $energeticoProducto = Producto::create([
            'nombre' => 'Zumo energético',
            'descripcion' => 'Bebida energética natural con frutas',
            'precio' => 5.00,
            'stock' => 5
        ]);

        $smoothieProducto = Producto::create([
            'nombre' => 'Smoothie frutos rojos',
            'descripcion' => 'Smoothie natural con frutos rojos',
            'precio' => 5.50,
            'stock' => 7
        ]);

        $verdeProducto = Producto::create([
            'nombre' => 'Zumo verde',
            'descripcion' => 'Zumo detox saludable con vegetales',
            'precio' => 4.80,
            'stock' => 9
        ]);

        //  RELACIONES N:M

        $naranja->categorias()->attach([
            $frutas->id,
            $saludable->id
        ]);

        $detoxProducto->categorias()->attach([
            $detox->id,
            $saludable->id
        ]);

        $tropicalProducto->categorias()->attach([
            $tropical->id,
            $frutas->id
        ]);

        $energeticoProducto->categorias()->attach([
            $energetico->id,
            $frutas->id
        ]);

        $smoothieProducto->categorias()->attach([
            $smoothie->id,
            $frutas->id,
            $saludable->id
        ]);

        $verdeProducto->categorias()->attach([
            $detox->id,
            $saludable->id,
            $vegetales->id
        ]);
    }
}