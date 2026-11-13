<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Cek jika kolom metode_pembayaran belum ada, buatkan otomatis
            if (!Schema::hasColumn('orders', 'metode_pembayaran')) {
                $table->string('metode_pembayaran')->default('Cashless')->after('no_telepon');
            }
            
            // Tambahkan snap_token dan status_pembayaran (tanpa kata 'after')
            $table->string('snap_token')->nullable();
            $table->string('status_pembayaran')->default('pending'); 
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['snap_token', 'status_pembayaran']);
            if (Schema::hasColumn('orders', 'metode_pembayaran')) {
                $table->dropColumn('metode_pembayaran');
            }
        });
    }
};