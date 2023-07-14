<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Add Foreign Key column
            $table->unsignedBigInteger('type_id');

            $table->string('title', 100);
            $table->string('slug', 100)->unique();
            $table->string('url_image', 200);
            $table->string('image', 200)->nullable();
            $table->text('description');
            $table->date('creation_date');
            $table->string('url_repo', 200);

            // define column as Foreign Key
            $table->foreign('type_id')->references('id')->on('types');

            $table->softDeletes();

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
        Schema::dropIfExists('projects');
    }
};
