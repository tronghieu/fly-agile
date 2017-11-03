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
            $table->integer('issue_id', false, true)->nullable()->index();
            $table->integer('task_status_id', false, true)->nullable()->index();
            $table->string('title');
            $table->text('description')->nullable();

            $table->double('estimate', 10, 2)->default(0);
            $table->double('consumed', 10, 2)->default(0);

            //user
            $table->integer('created_by', false, true)->nullable();
            $table->integer('assignee', false, true)->nullable()->index();

            $table->bigInteger('ordering')->nullable();
            $table->boolean('is_closed')->default(false);

            $table->timestampTz('closed_at')->nullable();
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
