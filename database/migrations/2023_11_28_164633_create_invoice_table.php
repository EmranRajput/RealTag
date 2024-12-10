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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id');
            $table->string('name',100);
            $table->string('identity_number',100);
            $table->string('invoice_number',255);
            $table->longtext('item_list');
            $table->decimal('sub_total',10,2);
            $table->decimal('service_tax',10,2);
            $table->decimal('total',10,2);
            $table->string('invoice_type');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};