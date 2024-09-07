<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_files', function (Blueprint $table) {
            $table->id(); // عمود للمفتاح الأساسي
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade'); // مفتاح خارجي يشير إلى جدول المشاريع
            $table->unsignedBigInteger('uploaded_by'); // حقل لمستخدم أنشأ الملف
            $table->string('file_path'); // مسار الملف
            $table->string('file_name'); // اسم الملف
            $table->timestamps(); // طوابع زمنية

            // تعريف العلاقة مع جدول المستخدمين
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_files');
    }
}
