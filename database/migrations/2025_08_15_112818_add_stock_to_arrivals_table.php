<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('arrivals') && !Schema::hasColumn('arrivals','stock')) {
            Schema::table('arrivals', function (Blueprint $table) {
                $table->integer('stock')->nullable()->after('description');
            });
        }
    }
    public function down(): void
    {
        if (Schema::hasTable('arrivals') && Schema::hasColumn('arrivals','stock')) {
            Schema::table('arrivals', function (Blueprint $table) {
                $table->dropColumn('stock');
            });
        }
    }
};
