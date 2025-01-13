<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('nip', 15)->unique()->nullable();
            $table->enum('jenis_kelamin', ['m', 'f']);
            $table->auditable();
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
        Schema::dropIfExists('teachers');
    }
}
