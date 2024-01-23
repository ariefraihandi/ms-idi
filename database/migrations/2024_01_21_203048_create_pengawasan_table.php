<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasanTable extends Migration
{
    public function up()
    {
        Schema::create('pengawasan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengawasan');
            $table->string('bidang');
            $table->string('subbidang');
            $table->string('tajuk');
            $table->text('kondisi');
            $table->text('kriteria');
            $table->text('sebab');
            $table->text('akibat');
            $table->text('rekomendasi');
            $table->string('pengawas');
            $table->string('eviden');
            $table->string('penanggung_jawab');
            $table->timestamps(); // datecreated dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengawasan');
    }
};
