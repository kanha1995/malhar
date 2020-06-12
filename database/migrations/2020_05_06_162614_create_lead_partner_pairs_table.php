<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadPartnerPairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_partner_pairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lead_id');
            $table->string('partner_id');
            $table->integer('status')->default(1); //1: Created, 2: Accepted
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
        Schema::dropIfExists('lead_partner_pairs');
    }
}
