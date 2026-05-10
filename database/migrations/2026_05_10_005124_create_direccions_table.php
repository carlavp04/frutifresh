<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direccions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('calle');

            $table->string('ciudad');

            $table->string('codigo_postal');

            $table->string('pais');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direccions');
    }
};
