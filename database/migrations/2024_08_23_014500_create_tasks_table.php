<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id'); 
            $table->foreignId('team_member_id'); 
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->string('status')->nullable();
            $table->integer('Value_Status');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('team_member_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
