<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPengawasanTable extends Migration
{
    public function up()
    {
        Schema::table('pengawasan', function (Blueprint $table) {
            $table->text('kondisiafter')->nullable()->after('eviden');
            $table->text('evidenafter')->nullable()->after('kondisiafter');
        });
    }

    public function down()
    {
        Schema::table('pengawasan', function (Blueprint $table) {
            $table->dropColumn('kondisiafter');
            $table->dropColumn('evidenafter');
        });
    }
};