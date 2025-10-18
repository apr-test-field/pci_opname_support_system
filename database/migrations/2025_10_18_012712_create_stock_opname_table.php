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
        Schema::create('stock_opname', function (Blueprint $table) {
            $table->id();
            $table->string('cell');           // Cell (lokasi)
            $table->string('item_name');      // SKU (Item Name)
            $table->string('tonality');       // Tonality (lot number)
            $table->integer('qty_utuh');      // Quantity Utuh
            $table->integer('qty_pecah');     // Quantity Pecah
            $table->text('note')->nullable(); // Note
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_opname');
    }
};
