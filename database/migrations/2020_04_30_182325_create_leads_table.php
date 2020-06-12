<?php

use App\RandomString;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lead_id');
            $table->string('name');
            $table->string('email');
            $table->string('url')->nullable();
            $table->string('city')->nullable();
            $table->string('country');
            $table->string('tags')->nullable();
            $table->boolean('worldwide')->default(0);
            $table->string('language');
            $table->boolean('translation')->default(0);
            $table->string('initial_requirement')->nullable();
            $table->string('note_to_partner')->nullable();
            $table->string('date_of_communicatin')->default(Carbon::now());
            $table->boolean('c2c')->default(0);
            $table->string('partner_search_keywords')->nullable();
            $table->integer('status')->default(1); // 1: Created, 2: Finished (Lead search finished. Converted to project), 3: Requeted, 4: Converted, 5: Partner Search
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
        Schema::dropIfExists('leads');
    }
}
