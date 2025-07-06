<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penumpang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penumpang', 100);
            $table->text('alamat');
            $table->string('nomor_hp', 20);
            $table->string('email')->unique();
            $table->string('tujuan', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penumpang');
    }
};