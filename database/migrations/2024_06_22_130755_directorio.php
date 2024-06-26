<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('tm_directorio', function (Blueprint $table) {
            $table->id();
            $table->integer('ext_id');
            $table->integer('order_id');
            $table->string('dep_nom', 150);
            $table->string('depto_nom', 150);
            $table->string('ext_num', 12);
            $table->string('usu_nom', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
