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
        Schema::create('room', function (Blueprint $table) {
            $table->id('room_id');
            $table->integer('room_number');
            $table->enum('room_type',['Small','Medium','Large'])->default('Small');
            $table->integer('room_floor')->nullable(false);
            $table->decimal('rental_price', 17, 2);
            $table->enum('status', ['available', 'booked', 'unavailable'])->default('available');
            $table->string('photo', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
