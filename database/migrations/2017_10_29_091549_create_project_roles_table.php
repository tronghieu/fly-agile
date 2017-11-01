<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id', false, true)->nullable()->index();
            $table->string('name');
            $table->boolean('able_to_estimate')->default(false);
            $table->timestamps();

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
        Schema::dropIfExists('project_roles');
    }
}
