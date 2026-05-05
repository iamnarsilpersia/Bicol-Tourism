<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('payment_method', ['full', 'downpayment', 'on_arrival'])->default('on_arrival')->after('total_price');
            $table->string('payment_mode')->nullable()->after('payment_method');
            $table->decimal('downpayment_amount', 10, 2)->default(0)->after('payment_mode');
            $table->enum('payment_status', ['paid', 'partial', 'unpaid'])->default('unpaid')->after('downpayment_amount');
        });

        Schema::table('tour_guide_bookings', function (Blueprint $table) {
            $table->enum('payment_method', ['full', 'downpayment', 'on_arrival'])->default('on_arrival')->after('notes');
            $table->string('payment_mode')->nullable()->after('payment_method');
            $table->decimal('downpayment_amount', 10, 2)->default(0)->after('payment_mode');
            $table->enum('payment_status', ['paid', 'partial', 'unpaid'])->default('unpaid')->after('downpayment_amount');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_mode', 'downpayment_amount', 'payment_status']);
        });

        Schema::table('tour_guide_bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_mode', 'downpayment_amount', 'payment_status']);
        });
    }
};