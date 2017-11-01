<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('project_id', false, true)->nullable()->index();
            $table->integer('issue_type_id', false, true)->nullable();
            $table->integer('status_id', false, true)->nullable();
//            $table->integer('closed_in', false, true)->nullable();
            $table->double('estimate_points', 10, 2)->default(0);
            $table->double('consumed_points', 10, 2)->default(0);
            $table->bigInteger('ordering');

            //issue's options
            $table->boolean('is_closed')->default(false);
            $table->boolean('is_task')->default(false);

            $table->integer('created_by', false, true)->nullable();
            $table->integer('assignee', false, true)->nullable();
            //time
            $table->timestampTz('closed_at');
            $table->timestampsTz();

            //relations
            /*$table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('restrict');

            $table->foreign('issue_type_id')
                ->references('id')->on('issue_types')
                ->onDelete('restrict');

            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('assignee')
                ->references('id')->on('users')
                ->onDelete('set null');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
