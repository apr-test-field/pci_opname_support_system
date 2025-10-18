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
        Schema::table('master_items', function (Blueprint $table) {
            // Menghapus unique constraint pada kolom 'item_code'
            $table->dropUnique(['item_code']); // Menghapus unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('master_items', function (Blueprint $table) {
            // Menambahkan kembali unique constraint pada kolom 'item_code' jika rollback
            $table->unique('item_code');
        });
    }
};
