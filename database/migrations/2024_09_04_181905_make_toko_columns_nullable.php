<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTokoColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->string('nama_toko')->nullable()->change();
            $table->string('latitude')->nullable()->change();
            $table->string('longitude')->nullable()->change();
            $table->string('area')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->string('nama_toko')->nullable(false)->change();
            $table->string('latitude')->nullable(false)->change();
            $table->string('longitude')->nullable(false)->change();
            $table->string('area')->nullable(false)->change();
        });
    }
}
