<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('voucher_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->foreignId('ticket_tier_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
            $table->dropForeign(['ticket_tier_id']);
            $table->dropColumn(['voucher_id', 'discount_amount', 'ticket_tier_id']);
        });
    }
};
