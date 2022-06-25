<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_diagnosas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pasien_id')->nullable();
            $table->unsignedInteger('penyakit_id')->nullable();
            $table->unsignedInteger('gejala')->nullable();
            $table->unsignedInteger('gejala_terpenuhi')->nullable();
            $table->unsignedInteger('persen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_diagnosas');
    }
};
