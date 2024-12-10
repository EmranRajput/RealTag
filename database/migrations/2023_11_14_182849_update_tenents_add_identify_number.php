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
         Schema::table('tanents', function (Blueprint $table) {
             $table->renameColumn("passport_number", "identify_number");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tanents', function (Blueprint $table) {
             $table->renameColumn("identify_number", "passport_number");
        });
    }
};