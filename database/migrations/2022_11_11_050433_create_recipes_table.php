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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('recipe_name',100)->nullable();;
            $table->text('ingredients')->nullable();;
            $table->json('steps')->nullable();;
            $table->string('cook_time',30)->nullable();;
            $table->string('prep_time',30)->nullable();;
            $table->string('serves',30)->nullable();;
            $table->string('image',100)->nullable();;
            $table->string('video',100)->nullable();
            $table->string('recomended_age',20)->nullable();;
            $table->enum('status', ['approved', 'disapprove'])->default('disapprove');
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
        Schema::dropIfExists('recipes');
    }
};
