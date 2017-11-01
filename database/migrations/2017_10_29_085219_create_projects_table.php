<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->integer('owner_id', false, true)->nullable()->index();
            //time
            $table->timestampTz('closed_at')->nullable();
            $table->timestampTz('deleted_at')->nullable();
            $table->timestamps();

            //relation
            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
}
