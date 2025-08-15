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
        Schema::create('badminton_equipment', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('type');
    $table->decimal('price', 8, 2);
    $table->text('description');
    $table->integer('quantity');
    $table->string('status')->nullable();
    $table->string('size')->nullable();
    $table->string('image_path')->nullable();
 // add this line

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badminton_equipment');
    }
};
