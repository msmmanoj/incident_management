<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_management', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('title');
            $table->integer('category');
            $table->text('people');
            $table->string('comments')->nullable(true);
            $table->timestamp('incidentDate', 0)->nullable();
            $table->timestamp('createDate', 0)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modifyDate', 0)->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_management');
    }
}
