<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
{
    Schema::table('football_equipment', function (Blueprint $table) {
        $table->integer('quantity')->default(0);
        $table->string('status')->default('available');
        $table->string('size')->nullable();
        // DO NOT add: $table->string('team')->nullable();
    });
}

public function down(): void
{
    Schema::table('football_equipment', function (Blueprint $table) {
        $table->dropColumn(['quantity', 'status', 'size']);
    });
}
};