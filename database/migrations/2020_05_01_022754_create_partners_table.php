<?php

use App\RandomString;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partner_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('country');
            $table->string('tags')->nullable();
            $table->string('linked_in')->nullable();
            $table->string('fb')->nullable();
            $table->string('fiverr')->nullable();
            $table->string('twitter')->nullable();
            $table->integer('type'); // 1. Company, 2. Freelancer, 3. Both
            $table->boolean('c2c');
            $table->integer('team_size')->nullable();
            $table->integer('block_status')->default(0); // 1: Blocked, 0. UnBlocked
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
        Schema::dropIfExists('partners');
    }
}
