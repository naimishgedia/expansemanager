<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('monthly_expanse', function (Blueprint $table) {
            $table->id();
            $table->dateTime('expanse_date');
            $table->decimal('amount', 15, 2); // Decimal for amounts
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->text('note')->nullable();
            $table->text('description')->nullable();
            $table->timestamps(); // Adds created_at and updated_at
            $table->softDeletes(); // Adds deleted_at

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('user_expanse_category')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_expanse_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_expanse');
    }
};
