<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("designation");
            $table->timestamps();
        });

        $data[]=['designation' => "Software Engineer" ];
        $data[]=['designation' => "System Analyst" ];
        $data[]=['designation' => "Project Lead" ];
        $data[]=['designation' => "Trainee Engineer" ];
        $data[]=['designation' => "Web Developer" ];

        DB::table('designations')->insert(
            $data 
          );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
    }
}
