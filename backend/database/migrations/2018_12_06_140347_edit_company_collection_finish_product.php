<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCompanyCollectionFinishProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finish_product', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->integer('collection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finish_product', function (Blueprint $table) {
            $table->integer('company_id');
            $table->dropColumn('collection_id');
        });
    }
}
