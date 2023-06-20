<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('id_number', 10)->unique();
            $table->string('bio', 100);
            $table->boolean('verified')->default(false);
            $table->tinyInteger('experience_years', false, true);
            $table->string('address', 45)->nullable();

            $table->foreignId('profession_id');
            $table->foreign('profession_id')->on('professions')->references('id');

            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('professionals');
    }
}
