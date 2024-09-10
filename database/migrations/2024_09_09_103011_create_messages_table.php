<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Sender of the message
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onDelete('cascade'); // Receiver (for private messages)
            $table->foreignId('team_id')->nullable()->constrained('teams')->onDelete('cascade'); // Linked team (for group messages)
            $table->text('message'); // Message content
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
        Schema::dropIfExists('messages');
    }
}
