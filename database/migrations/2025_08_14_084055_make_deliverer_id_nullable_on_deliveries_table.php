<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('deliveries')) return;

        Schema::table('deliveries', function (Blueprint $table) {
            // Drop existing FK if present
            try { $table->dropForeign(['deliverer_id']); } catch (\Throwable $e) {}

            // Make column nullable (requires doctrine/dbal)
            if (Schema::hasColumn('deliveries', 'deliverer_id')) {
                $table->unsignedBigInteger('deliverer_id')->nullable()->change();
            }

            // Re-add FK (nullable; set null on user delete)
            $table->foreign('deliverer_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('deliveries')) return;

        Schema::table('deliveries', function (Blueprint $table) {
            try { $table->dropForeign(['deliverer_id']); } catch (\Throwable $e) {}

            if (Schema::hasColumn('deliveries', 'deliverer_id')) {
                $table->unsignedBigInteger('deliverer_id')->nullable(false)->change();
            }

            $table->foreign('deliverer_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
