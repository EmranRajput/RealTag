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
         Schema::table('whatsapp_intances', function (Blueprint $table) {
            $table->integer('is_busy')->after('queue_status')->default(0);
            $table->string('phone_number')->nullable()->after('is_busy');
            $table->integer('user_id')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('whatsapp_intances', function (Blueprint $table) {
            $table->dropColumn('is_busy');
            $table->dropColumn('phone_number');
            $table->dropColumn('user_id');
            
        });
    }
};