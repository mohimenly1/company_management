<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الفريق
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // يربط الفريق بمشروع
            $table->unsignedBigInteger('leader_id')->nullable(); // تأكد من أن العمود موجود
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('set null'); // يربط الفريق بالقائد
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
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
        Schema::dropIfExists('teams');
    }
}
