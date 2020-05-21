<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDevWeixinOpenidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('dev_weixin_openid')->unique()->nullable();
            $table->string('dev_weixin_unionid')->unique()->nullable();
            $table->string('wf_weixin_openid')->unique()->nullable();
            $table->string('wf_weixin_unionid')->unique()->nullable();
            $table->string('weipu_weixin_openid')->unique()->nullable();
            $table->string('weipu_weixin_unionid')->unique()->nullable();
            $table->string('paperpass_weixin_openid')->unique()->nullable();
            $table->string('paperpass_weixin_unionid')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('dev_weixin_openid');
            $table->dropColumn('dev_weixin_unionid');
            $table->dropColumn('wf_weixin_openid');
            $table->dropColumn('wf_weixin_unionid');
            $table->dropColumn('weipu_weixin_openid');
            $table->dropColumn('weipu_weixin_unionid');
            $table->dropColumn('paperpass_weixin_openid');
            $table->dropColumn('paperpass_weixin_unionid');
        });
    }
}
