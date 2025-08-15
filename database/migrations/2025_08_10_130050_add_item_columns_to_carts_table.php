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
    Schema::table('carts', function (Blueprint $table) {
        $table->string('item_type')->nullable()->after('id'); // cricket, football, etc.
        $table->unsignedBigInteger('item_id')->nullable()->after('item_type'); // product ID
    });
}

public function down(): void
{
    Schema::table('carts', function (Blueprint $table) {
        $table->dropColumn(['item_type', 'item_id']);
    });
}
};
