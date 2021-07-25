<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cat_id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        DB::table('incident_category')->insert([
            [
                'cat_id' => 1,
                'name'   => 'Security'
            ],
            [
                'cat_id' => 2,
                'name'   => 'Health & Safety'
            ],
            [
                'cat_id' => 3,
                'name'   => 'Loss Prevention'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_category');
    }
}
