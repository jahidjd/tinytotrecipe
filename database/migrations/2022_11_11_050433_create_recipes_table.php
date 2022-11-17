<?php

use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
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
            $table->varchar('recipe_name',100)->nullable();;
            $table->text('ingredients')->nullable();;
            $table->json('steps')->nullable();;
            $table->varchar('cook_time',30)->nullable();;
            $table->varchar('prep_time',30)->nullable();;
            $table->varchar('serves',30)->nullable();;
            $table->varchar('image',100)->nullable();;
            $table->varchar('video',100)->nullable();
            $table->varchar('recomended_age',20)->nullable();;
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
