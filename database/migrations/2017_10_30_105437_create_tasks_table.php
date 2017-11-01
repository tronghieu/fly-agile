<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id', false, true)->nullable()->index();
            $table->integer('task_status_id', false, true)->nullable()->index();
            $table->string('title');
            $table->text('description')->nullable();

            $table->double('estimate', 10, 2)->default(0);
            $table->double('consumed', 10, 2)->default(0);

            //user
            $table->integer('create_by', false, true)->nullable();
            $table->integer('assignee', false, true)->nullable()->index();

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
