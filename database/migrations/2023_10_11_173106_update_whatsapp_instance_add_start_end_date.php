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
            $table->integer('start_value')->default(0)->after('qrcode_status');
            $table->integer('end_value')->default(5)->after('start_value');
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
            $table->dropColumn('start_value');
            $table->dropColumn('end_value');
            
        });
    }
};