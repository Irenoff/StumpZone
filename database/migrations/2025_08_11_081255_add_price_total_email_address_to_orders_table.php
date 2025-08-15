<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // add price/total if missing
            if (!Schema::hasColumn('orders', 'price')) {
                $table->decimal('price', 10, 2)->default(0)->after('quantity');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->default(0)->after('price');
            }

            // add customer_email/address if missing (nullable to avoid failing on old rows)
            if (!Schema::hasColumn('orders', 'customer_email')) {
                $table->string('customer_email')->nullable()->after('total');
            }
            if (!Schema::hasColumn('orders', 'customer_address')) {
                $table->text('customer_address')->nullable()->after('customer_email');
            }

            // (Optional, if you plan to store delivery info)
            if (!Schema::hasColumn('orders', 'delivery_method')) {
                $table->string('delivery_method')->nullable()->after('customer_address');
            }
            if (!Schema::hasColumn('orders', 'delivery_fee')) {
                $table->decimal('delivery_fee', 10, 2)->default(0)->after('delivery_method');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'delivery_fee'))    $table->dropColumn('delivery_fee');
            if (Schema::hasColumn('orders', 'delivery_method')) $table->dropColumn('delivery_method');
            if (Schema::hasColumn('orders', 'customer_address'))$table->dropColumn('customer_address');
            if (Schema::hasColumn('orders', 'customer_email'))  $table->dropColumn('customer_email');
            if (Schema::hasColumn('orders', 'total'))           $table->dropColumn('total');
            if (Schema::hasColumn('orders', 'price'))           $table->dropColumn('price');
        });
    }
};
