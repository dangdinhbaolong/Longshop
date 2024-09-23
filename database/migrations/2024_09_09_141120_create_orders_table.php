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
            $table->id(); // ID tự tăng của đơn hàng
            $table->string('order_number')->unique(); // Mã đơn hàng duy nhất
            $table->unsignedBigInteger('user_id'); // ID của người dùng, là khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Khóa ngoại đến bảng users
            $table->decimal('total_amount', 10, 2); // Tổng số tiền
            $table->string('currency')->default('usd'); // Loại tiền
            $table->string('status')->default('pending'); // Trạng thái đơn hàng
            $table->string('payment_id')->nullable(); // ID thanh toán từ Stripe
            $table->timestamps(); // Tạo cột created_at và updated_at
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
