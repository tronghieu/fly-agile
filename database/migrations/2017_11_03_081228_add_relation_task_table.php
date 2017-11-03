<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('issue_id')
                ->references('id')->on('issues')
                ->onDelete('cascade');

            $table->foreign('task_status_id')
                ->references('id')->on('task_statuses')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_issue_id_foreign');
            $table->dropForeign('tasks_task_status_id_foreign');
        });
    }
}
