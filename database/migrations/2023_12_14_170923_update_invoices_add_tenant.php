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
        Schema::table('invoices', function (Blueprint $table) {
             $table->integer("tenant_id")->after('agent_id')->nullable();
             $table->integer("created_by_cron")->default(0)->after('invoice_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('invoices', function (Blueprint $table) {
           $table->dropColumn("tenant_id");
           $table->dropColumn("created_by_cron");
        });
    }
};