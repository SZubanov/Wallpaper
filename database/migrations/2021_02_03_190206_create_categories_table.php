<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('emoji')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('name_ru')->nullable();
            $table->string('name_en')->nullable();
            $table->integer('rating')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->integer('sort')->nullable();
            $table->timestamps();

            $table->foreign('media_id')
                ->references('id')->on('media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
