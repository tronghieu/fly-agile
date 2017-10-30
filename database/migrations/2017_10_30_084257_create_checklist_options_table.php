<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option');
            $table->integer('checklist_id', false, true)->nullable()->index();
            $table->boolean('is_checked')->default(false);
            $table->integer('checker', false, true)->nullable();
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
        Schema::dropIfExists('checklist_options');
    }
}
