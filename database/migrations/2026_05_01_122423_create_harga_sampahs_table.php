<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('harga_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_sampah');
            $table->string('kategori');
            $table->decimal('harga_per_kg', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->string('satuan')->default('kg');
            $table->string('gambar')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('harga_sampahs');
    }
};