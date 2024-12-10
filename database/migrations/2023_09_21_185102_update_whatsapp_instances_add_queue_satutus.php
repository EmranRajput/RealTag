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
            $table->integer('queue_status')->default(0)->after('instance_expiry');
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
            $table->dropColumn('queue_status');
            
        });
    }
};