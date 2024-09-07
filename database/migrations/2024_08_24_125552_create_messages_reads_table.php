<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesReadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('message_reads', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('message_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
                
                // Foreign keys
                $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages_reads');
    }
}
