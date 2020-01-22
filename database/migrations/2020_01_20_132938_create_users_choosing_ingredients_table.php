<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersChoosingIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_choosing_ingredients', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('ingredient_id')->unsigned();
            $table->foreign('user_id')
                            ->references('id')->on('users');
            $table->foreign('ingredient_id')
                            ->references('id')->on('ingredients');
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
        Schema::dropIfExists('users_choosing_ingredients');
    }
}
