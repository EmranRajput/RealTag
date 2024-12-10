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
       
      Schema::create('whatsapp_msg_deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('file_id')->nullable();
            $table->string('number');
            $table->string('msg_response_id')->nullable();
            $table->boolean('status')->default(0);
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('whatsapp_msg_deliveries');
    }
};