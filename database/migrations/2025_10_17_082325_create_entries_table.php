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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_item_id');
            $table->integer('qty_utuh');
            $table->integer('qty_pecah');
            $table->text('note')->nullable();
            $table->string('cell');
            $table->date('entry_date');
            $table->timestamps();

            $table->foreign('master_item_id')->references('id')->on('master_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
