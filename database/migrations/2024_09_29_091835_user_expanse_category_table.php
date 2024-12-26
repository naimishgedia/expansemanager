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
        Schema::create('user_expanse_category', function (Blueprint $table) {
            $table->id(); // Automatically creates an auto-incrementing 'id' column
            $table->string('category_name'); // Column for category name
            $table->decimal('estimate_exp', 10, 2); // Column for estimated expense (up to 99999999.99)
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
            $table->softDeletes(); // Adds 'deleted_at' column for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_expanse_category');
    }
};
