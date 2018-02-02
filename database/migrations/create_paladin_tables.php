<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaladinTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->unique();
                $table->string('email', 255)->unique();
                $table->string('password', 60);
                $table->text('description')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (Schema::hasTable('permissions')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->integer('category_id')->nullable();
                $table->text('description')->nullable();
            });
        }

        if (!Schema::hasTable('permission_category')) {
            Schema::create('permission_category', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 50)->unique();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('permission_relations')) {
            Schema::create('permission_relations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('permission_id');
                $table->integer('related_id');
                $table->unique(['permission_id','related_id']);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('menu')) {
            Schema::create('menu', function (Blueprint $table) {
                $table->increments('id');
                $table->string('icon', 100)->nullable();
                $table->string('name', 30)->unique();
                $table->string('url', 200)->nullable();
                $table->integer('permission_id');
                $table->integer('parent_id')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('menu_relations')) {
            Schema::create('menu_relations', function (Blueprint $table) {
                $table->increments('id');
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
        Schema::dropIfExists('admins');
        Schema::dropIfExists('permission_category');
        Schema::dropIfExists('permission_relations');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('menu_relations');
    }
}
