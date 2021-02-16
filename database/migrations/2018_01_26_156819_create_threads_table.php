<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('best_reply_id')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->boolean('locked')->default(false);
            $table->unsignedBigInteger('replies_count')->default(0);
            $table->unsignedBigInteger('bookmark')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            //$table->string('img_thread')->default(null); //Указывает значение "по умолчанию" для столбца
            //$table->string('img_thread')->nullable()	;//Разрешает вставлять значения NULL в столбец
            $table->string('title');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('best_reply_id')
                ->references('id')->on('replies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
