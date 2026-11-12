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
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id'); // Terhubung ke tabel pesanan
        $table->foreignId('produksi_id'); // Barang apa yang dibeli
        $table->integer('jumlah_beli');
        $table->integer('harga_satuan');
        $table->timestamps();
    });
}
};
