<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("department");
            $table->timestamps();
        });

        //

        $data[]=['department' => "Human Resource" ];
        $data[]=['department' => "Marketing" ];
        $data[]=['department' => "Finance" ];
        $data[]=['department' => "Sales" ];
        $data[]=['department' => "Development" ];
        DB::table('departments')->insert(
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
        Schema::dropIfExists('departments');
    }
}
