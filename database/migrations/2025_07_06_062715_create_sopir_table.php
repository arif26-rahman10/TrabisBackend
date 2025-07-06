<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopirTable extends Migration
{
    public function up(): void
    {
        Schema::create('sopir', function (Blueprint $table) {
            $table->bigIncrements('id_supir');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp')->nullable();
            $table->integer('biaya')->nullable();
            $table->string('mobil')->nullable();
            $table->string('plat_mobil')->nullable();
            $table->string('gambarMobil')->nullable(); // path gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sopir');
    }
}
