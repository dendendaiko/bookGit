<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigIncrements('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('bookTitle', 100);
                $table->string('bookAuthor', 30);
                $table->unsignedInteger('progress');
                //①積　②途中　③読了済
                $table->unsignedInteger('media');
                //①紙　②電子
                $table->text('note');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
