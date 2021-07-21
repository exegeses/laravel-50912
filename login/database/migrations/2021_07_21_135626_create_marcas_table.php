<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {
            //$table->id();//primaryKey bigIncrement not null
            $table->tinyIncrements('idMarca');// primaryKey tinyInt not null
            $table->string('mkNombre', 30);//varchar 65535
            //$table->timestamps();// updated_at  created_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcas');
    }
}
