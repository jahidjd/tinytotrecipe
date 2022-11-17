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
            $table->char('recipe_name','100');
            $table->text('ingredients');
            $table->json('steps');
            $table->char('cook_time','30');
            $table->char('prep_time','30');
            $table->char('serves','30');
            $table->char('image','100');
            $table->char('video','100')->nullable();
            $table->char('recomended_age','20');
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
