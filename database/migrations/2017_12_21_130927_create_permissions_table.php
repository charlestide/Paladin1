<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 50)->unique()->comment('for display');
                $table->string('guard_name', 50)->comment('for auth');
                $table->integer('category_id');
                $table->text('description')->nullable();
                $table->timestamps();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_category');
        Schema::dropIfExists('permission_relations');
    }
}
