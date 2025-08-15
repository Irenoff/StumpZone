<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Who wrote the review
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // (Optional) which order this review is tied to
            // Remove ->constrained() if your orders.id isn't a BIGINT
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();

            // Review content
            $table->unsignedTinyInteger('rating'); // 1..5
            $table->string('title')->nullable();
            $table->text('body');

            // Moderation fields (optional)
            $table->boolean('is_public')->default(true);
            $table->timestampTz('approved_at')->nullable();

            $table->timestampsTz(); // created_at/updated_at with timezone
        });

        // Useful index if you’ll filter by public only
        Schema::table('reviews', function (Blueprint $table) {
            $table->index(['is_public', 'approved_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
