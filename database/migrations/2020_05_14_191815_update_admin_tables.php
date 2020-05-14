<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdminTables extends Migration
{
    public function getConnection()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    public function up()
    {
        Schema::table(config('admin.database.permissions_table'), function (Blueprint $table) {
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
        });
    }

    public function down()
    {
        Schema::table(config('admin.database.permissions_table'), function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('order');
        });
    }
}
