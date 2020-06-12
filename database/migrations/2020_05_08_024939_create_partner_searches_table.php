<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_searches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('search_id');
            $table->string('lead_id');
            $table->integer('status')->default(1); //1: Requested, 2: Partner Seached
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
        Schema::dropIfExists('partner_searches');
    }
}
