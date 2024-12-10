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
        Schema::create('rental_agreements', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id');
            $table->integer('tenant_id');
            $table->integer('landlord_id');
            $table->string('address',255);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('duration');
            $table->decimal('rental_amount',10,2);
            $table->decimal('security_deposit',10,2);
            $table->decimal('utility_deposit',10,2);
            $table->integer('agent_service')->default(1);
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
        Schema::dropIfExists('rental_agreements');
    }
};