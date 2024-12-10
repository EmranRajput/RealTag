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

        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_guest')->after('identity_number')->nullable();
        });

        Schema::table('rental_agreements', function (Blueprint $table) {
            $table->integer('agreement_id')->after('landlord_id');
        });
        

        // Schema::create('guests', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('tenant_name');
        //     $table->string('landlord_name');
        //     $table->unsignedBigInteger('landlord_ic_no');
        //     $table->unsignedBigInteger('tenant_ic_no');
        //     $table->integer('status')->default(1);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_guest');
           
        });
        Schema::table('rental_agreements', function (Blueprint $table) {
            $table->dropColumn('agreement_id');
           
        });
    }
};