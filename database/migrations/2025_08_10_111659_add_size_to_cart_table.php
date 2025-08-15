<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Use the actual table name: 'carts' (plural)
        if (Schema::hasTable('carts') && ! Schema::hasColumn('carts', 'size')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->string('size')->nullable()->after('id'); // adjust position if you like
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('carts') && Schema::hasColumn('carts', 'size')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }
    }
};
