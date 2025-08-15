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
    Schema::create('arrivals', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('sport'); // cricket, football, etc.
        $table->decimal('price', 10, 2);
        $table->text('description')->nullable();
        $table->integer('stock')->nullable();
        $table->string('image_path')->nullable(); // stored in storage/app/public/arrivals
        $table->string('status')->default('active'); // active|draft
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrivals');
    }
};
