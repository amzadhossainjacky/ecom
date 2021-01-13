<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitesetting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone_one');
            $table->string('phone_two');
            $table->string('email');
            $table->string('company_name');
            $table->text('company_address');
            $table->text('facebook');
            $table->text('instagram');
            $table->text('youtube');
            $table->text('twitter');
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
        Schema::dropIfExists('sitesetting');
    }
}
