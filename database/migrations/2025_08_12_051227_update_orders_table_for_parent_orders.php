<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'order_number')) {
                $table->string('order_number')->nullable()->index();
            }
            if (!Schema::hasColumn('orders', 'items_total')) {
                $table->decimal('items_total', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'delivery_fee')) {
                $table->decimal('delivery_fee', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'grand_total')) {
                $table->decimal('grand_total', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status', 32)->default('processing');
            }
            if (!Schema::hasColumn('orders', 'processing_message')) {
                $table->text('processing_message')->nullable();
            }
        });
    }

    public function down(): void
    {
        // keep columns; no destructive rollback by default
    }
};
