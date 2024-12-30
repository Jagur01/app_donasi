<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('file_qr')->after('status'); // Ganti 'nama_kolom_terakhir' dengan nama kolom sebelum 'file_qr'
        });
    }
    
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('file_qr');
        });
    }
    
};
