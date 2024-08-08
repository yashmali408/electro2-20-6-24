
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
            $table->integer('customer_id')->nullable(false);
            $table->integer('product_id')->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->decimal('purchased_price', 8, 2)->nullable(false);
            $table->enum('payment_mode', ['CC', 'DC', 'UPI', 'COD'])->default('COD')->nullable(false);
            $table->timestamps();
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
