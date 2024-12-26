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
         Schema::table('user_expanse_category', function (Blueprint $table) {
            $table->string('category_icon')->nullable()->after('category_name'); // Adding 'category_icon' after 'category_name'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('user_expanse_category', function (Blueprint $table) {
            $table->dropColumn('category_icon'); // Dropping 'category_icon' column
        });
    }
};
