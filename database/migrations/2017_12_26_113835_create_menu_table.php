<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('menu')) {
            Schema::create('menu', function (Blueprint $table) {
                $table->increments('id');
                $table->string('icon', 100)->nullable();
                $table->string('name', 30)->unique();
                $table->string('url', 200)->nullable();
                $table->string('path', 50);
                $table->integer('permission_id');
                $table->integer('parent_id')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('menu_relations')) {
            Schema::create('menu_relations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('path', 50);
                $table->integer('menu_id');
                $table->integer('related_id');
                $table->unique(['menu_id','related_id']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
        Schema::dropIfExists('menu_relations');
    }
}
