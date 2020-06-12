<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('detail')->nullable();
            $table->string('series_number');
            $table->date('registration_date');
            $table->date('repaired')->nullable();
            $table->date('taken_back')->nullable();
            $table->double('price', 8, 2);
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('repairer_id')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('repairer_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
