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
         Schema::table('user_income_category', function (Blueprint $table) {
            $table->string('category_icon')->nullable()->after('estimate_income'); // Add category_icon field
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_income_category', function (Blueprint $table) {
            $table->dropColumn('category_icon'); // Remove category_icon field
        });
    }
};
