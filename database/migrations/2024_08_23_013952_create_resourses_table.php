<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resourses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // يربط المورد بالمشروع
            $table->string('name'); // اسم المورد
            $table->text('description')->nullable(); // وصف المورد
            $table->integer('quantity'); // كمية المورد
            $table->decimal('cost', 10, 2); // تكلفة المورد
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
        Schema::dropIfExists('resourses');
    }
}
