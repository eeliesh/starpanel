<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('account_created')->default(0)->after('avatar');
            $table->integer('played_time')->default(0)->after('account_created');
            $table->integer('kills')->default(0)->after('played_time');
            $table->integer('deaths')->default(0)->after('kills');
            $table->integer('headshots')->default(0)->after('deaths');
            $table->dropColumn('player_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_created');
            $table->dropColumn('played_time');
            $table->dropColumn('kills');
            $table->dropColumn('deaths');
            $table->dropColumn('headshots');
            $table->integer('player_id')->default(0)->nullable();
        });
    }
};
