<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // If table doesn't exist yet (fresh DB), nothing to do here
        if (!Schema::hasTable('badminton_equipment')) return;

        Schema::table('badminton_equipment', function (Blueprint $table) {
            // Already has the target column -> nothing to do
            if (Schema::hasColumn('badminton_equipment', 'image_path')) {
                return;
            }

            // If legacy column exists -> rename it
            if (Schema::hasColumn('badminton_equipment', 'image_url')) {
                // Requires doctrine/dbal on Postgres
                $table->renameColumn('image_url', 'image_path');
                return;
            }

            // Neither exists -> create the new one
            $table->string('image_path')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('badminton_equipment')) return;

        Schema::table('badminton_equipment', function (Blueprint $table) {
            // Only rename back if we don't already have image_url
            if (!Schema::hasColumn('badminton_equipment', 'image_url')
                && Schema::hasColumn('badminton_equipment', 'image_path')) {
                $table->renameColumn('image_path', 'image_url');
            }
        });
    }
};
