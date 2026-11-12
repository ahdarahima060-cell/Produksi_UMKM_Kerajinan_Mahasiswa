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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id'); // Siapa yang beli
        $table->string('nama_penerima');
        $table->string('no_telepon');
        $table->text('alamat_pengiriman');
        $table->integer('total_harga');
        $table->string('status')->default('Menunggu Pembayaran');
        $table->timestamps();
    });
}
};
