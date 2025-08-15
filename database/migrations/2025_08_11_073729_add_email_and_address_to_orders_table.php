<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_email')->nullable()->after('user_id');   // start nullable
            $table->text('customer_address')->nullable()->after('customer_email');
        });

        // Backfill existing rows from users (Postgres-friendly raw SQL)
        // Make sure your users table has 'address' (nullable is fine)
        DB::statement("
            UPDATE orders o
            SET customer_email   = u.email,
                customer_address = u.address
            FROM users u
            WHERE o.user_id = u.id
              AND o.customer_email IS NULL
        ");

        // Optional: now enforce NOT NULL on email (safe after backfill)
        DB::statement('ALTER TABLE orders ALTER COLUMN customer_email SET NOT NULL');
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_email', 'customer_address']);
        });
    }
};
