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
        Schema::table('sub_expanse_category', function (Blueprint $table) {
                    Schema::table('sub_expanse_category', function (Blueprint $table) {
						$table->unsignedBigInteger('exp_cat_id')->after('user_id'); // Add the field after 'user_id'
					});

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('sub_expanse_category', function (Blueprint $table) {
            $table->dropColumn('exp_cat_id'); // Remove the column if the migration is rolled back
        });
    }
};
