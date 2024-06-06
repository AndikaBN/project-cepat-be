<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->string('location_id');
            $table->string('day');
            $table->enum('status', ['checkin', 'checkout']);
            $table->string('latitude');
            $table->string('longitude');
            $table->foreignId('data_otlets_id')->constrained('data_otlets');
            $table->string('outlet_name');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
};
