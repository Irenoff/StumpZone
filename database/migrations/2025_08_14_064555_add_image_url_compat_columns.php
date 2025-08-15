<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private array $tables = [
        'products',
        'cricket_equipment',
        'football_equipment',
        'basketball_equipment',
        'badminton_equipment',
        'boxing_equipment',
        // add any other equipment tables you use
    ];

    public function up(): void
    {
        foreach ($this->tables as $t) {
            if (!Schema::hasTable($t)) continue;

            // If table has image_path but no image_url → add image_url and backfill
            if (Schema::hasColumn($t, 'image_path') && !Schema::hasColumn($t, 'image_url')) {
                Schema::table($t, function (Blueprint $table) {
                    $table->string('image_url')->nullable()->after('image_path');
                });

                // Copy values from image_path to image_url (Postgres-safe)
                DB::table($t)->update([
                    'image_url' => DB::raw('image_path')
                ]);
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $t) {
            if (!Schema::hasTable($t)) continue;
            if (Schema::hasColumn($t, 'image_url')) {
                Schema::table($t, function (Blueprint $table) {
                    $table->dropColumn('image_url');
                });
            }
        }
    }
};
