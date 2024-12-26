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
        Schema::create('user_income_category', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('category_name'); // Category name
            $table->decimal('estimate_income', 10, 2); // Estimated income (decimal with 2 places)
            $table->timestamps(); // created_at and updated_at timestamps
            $table->softDeletes(); // deleted_at for soft deletes
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_income_category');
    }
};
