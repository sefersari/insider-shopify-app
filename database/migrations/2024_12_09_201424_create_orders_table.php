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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('company_id')->index();

            $table->string('order_number')
                ->unique()
                ->index();

            $table->string('external_order_number')
                ->unique()
                ->index();

            $table->decimal('total_amount', 12,4);

            $table->string('customer_email_address')->nullable();

            $table->date('ordered_date');

            $table->dateTime('created_at')
                ->useCurrent();

            $table->dateTime('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
