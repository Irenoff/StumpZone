<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // If orders table is missing entirely, stop (your create_orders_table should run first)
        if (!Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            // identifiers / status
            if (!Schema::hasColumn('orders', 'order_number')) {
                $table->string('order_number')->nullable()->index();
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->index();
            }

            // totals
            if (!Schema::hasColumn('orders', 'items_total')) {
                $table->decimal('items_total', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'delivery_fee')) {
                $table->decimal('delivery_fee', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'grand_total')) {
                $table->decimal('grand_total', 12, 2)->default(0);
            }

            // customer & shipping
            if (!Schema::hasColumn('orders', 'processing_message')) {
                $table->string('processing_message')->nullable();
            }
            if (!Schema::hasColumn('orders', 'customer_email')) {
                $table->string('customer_email')->nullable()->index();
            }
            if (!Schema::hasColumn('orders', 'customer_address')) {
                $table->text('customer_address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_method')) {
                $table->string('delivery_method')->nullable(); // e.g., standard/overnight
            }

            // quick single-item fields (your code is inserting these)
            if (!Schema::hasColumn('orders', 'sport_type')) {
                $table->string('sport_type')->nullable(); // cricket/football/…/mixed
            }
            if (!Schema::hasColumn('orders', 'equipment_id')) {
                $table->unsignedBigInteger('equipment_id')->nullable(); // if you ever FK this, do it later
            }
            if (!Schema::hasColumn('orders', 'quantity')) {
                $table->integer('quantity')->default(1);
            }
            if (!Schema::hasColumn('orders', 'price')) {
                $table->decimal('price', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 12, 2)->default(0);
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('orders')) {
            return;
        }

        // Dropping is optional; safe checks included. Requires doctrine/dbal for some DBs.
        Schema::table('orders', function (Blueprint $table) {
            foreach ([
                'order_number','status','items_total','delivery_fee','grand_total',
                'processing_message','customer_email','customer_address','delivery_method',
                'sport_type','equipment_id','quantity','price','total'
            ] as $col) {
                if (Schema::hasColumn('orders', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
