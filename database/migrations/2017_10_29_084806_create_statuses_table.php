<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->integer('project_id', false, true)->nullable()->index();
            $table->integer('issue_type_id', false, true)->nullable()->index();
            $table->string('name');
            $table->string('color');
            $table->bigInteger('ordering_id')->nullable();
            $table->timestampTz('deleted_at')->nullable();
            $table->timestampsTz();

            /*$table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
