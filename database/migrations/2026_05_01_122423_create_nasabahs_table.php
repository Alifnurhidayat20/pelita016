<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('nasabahs')) {
            Schema::create('nasabahs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('no_rekening')->unique();
                $table->decimal('saldo', 15, 2)->default(0);
                $table->string('nik')->unique();
                $table->string('tempat_lahir');
                $table->date('tanggal_lahir');
                $table->enum('jenis_kelamin', ['L', 'P']);
                $table->string('pekerjaan')->nullable();
                $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
                $table->string('foto')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('nasabahs');
    }
};