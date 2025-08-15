<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('deliveries')) return;

        // 1) Drop existing FK (name may vary; use IF EXISTS)
        DB::statement('ALTER TABLE deliveries DROP CONSTRAINT IF EXISTS deliveries_deliverer_id_foreign');

        // 2) Make deliverer_id nullable (no doctrine/dbal needed)
        //    If column does not exist for some reason, do nothing.
        $hasCol = DB::selectOne("
            SELECT 1 AS x
            FROM information_schema.columns
            WHERE table_name = 'deliveries' AND column_name = 'deliverer_id'
        ");
        if ($hasCol) {
            DB::statement('ALTER TABLE deliveries ALTER COLUMN deliverer_id DROP NOT NULL');
        }

        // 3) Re-add FK with ON DELETE SET NULL
        DB::statement('ALTER TABLE deliveries ADD CONSTRAINT deliveries_deliverer_id_foreign
                       FOREIGN KEY (deliverer_id) REFERENCES users(id) ON DELETE SET NULL');
    }

    public function down(): void
    {
        if (!Schema::hasTable('deliveries')) return;

        // Reverse: drop FK, set NOT NULL, add FK with CASCADE (or whatever you had)
        DB::statement('ALTER TABLE deliveries DROP CONSTRAINT IF EXISTS deliveries_deliverer_id_foreign');

        $hasCol = DB::selectOne("
            SELECT 1 AS x
            FROM information_schema.columns
            WHERE table_name = 'deliveries' AND column_name = 'deliverer_id'
        ");
        if ($hasCol) {
            DB::statement('ALTER TABLE deliveries ALTER COLUMN deliverer_id SET NOT NULL');
        }

        DB::statement('ALTER TABLE deliveries ADD CONSTRAINT deliveries_deliverer_id_foreign
                       FOREIGN KEY (deliverer_id) REFERENCES users(id) ON DELETE CASCADE');
    }
};
