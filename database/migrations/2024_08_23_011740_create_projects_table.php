<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->decimal('budget', 10, 2);
            $table->string('status')->nullable();
            $table->integer('Value_Status');
            $table->date('start_date')->nullable(); 
            $table->date('end_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('projects');
    }
}
