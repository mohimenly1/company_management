<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectphasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectphases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // يربط المرحلة بالمشروع
            $table->string('name'); // اسم المرحلة
            $table->text('description')->nullable(); // وصف المرحلة
            $table->date('start_date')->nullable(); // تاريخ بدء المرحلة
            $table->date('end_date')->nullable(); // تاريخ انتهاء المرحلة
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
        Schema::dropIfExists('projectphases');
    }
}
