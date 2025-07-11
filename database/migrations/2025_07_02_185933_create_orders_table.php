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
            $table->datetime('bl_release_date');
            $table->unsignedBigInteger('bl_release_user_id');
            $table->boolean('freight_payer_self')->default(false);
            $table->string('contract_number');
            $table->string('bl_number');
            $table->timestamps();

            $table->foreign('bl_release_user_id')->references('id')->on('users')->onDelete('cascade');
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
