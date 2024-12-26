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
            $table->string('income_category')->after('category_name'); // Adds the income_category field
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
            $table->dropColumn('income_category'); // Drops the income_category field when rolled back
        });
    }
};
