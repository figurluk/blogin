<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('articles_id')->unsigned()->nullable();
            $table->foreign('articles_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer('comments_id')->unsigned()->nullable();
            $table->foreign('comments_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('topped')->default(false);
            $table->string('code')->default("");
            $table->string('image')->default('default.png');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('admin')->default(false);
            $table->softDeletes();
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->string('code')->default('');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
