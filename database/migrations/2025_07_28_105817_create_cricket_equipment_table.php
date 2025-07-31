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
       Schema::create('cricket_equipment', function (Blueprint $table) {
        $table->id(); // this makes an auto-increment ID
        $table->string('name'); // name of the equipment
        $table->text('description'); // description of the equipment
        $table->decimal('price', 8, 2); // price (like 99.99)
        $table->string('image_path')->nullable(); // to store image filename
        $table->timestamps(); // created_at, updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cricket_equipment');
    }
};
