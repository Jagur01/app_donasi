<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            if (!Schema::hasColumn('campaigns', 'bank_info')) {
                $table->string('bank_info')->nullable()->after('category_id');
            }
        });
    }

    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            if (Schema::hasColumn('campaigns', 'bank_info')) {
                $table->dropColumn('bank_info');
            }
        });
    }
};
