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
            $table->string('role')->default('user')->after('email');
            $table->string('player_id')->nullable()->after('role');
            $table->string('reg_ip_address')->nullable()->after('player_id');
            $table->mediumText('other_ips')->nullable()->after('reg_ip_address');
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
            $table->dropColumn('role');
            $table->dropColumn('player_id');
            $table->dropColumn('reg_ip_address');
            $table->dropColumn('other_ips');
        });
    }
};
