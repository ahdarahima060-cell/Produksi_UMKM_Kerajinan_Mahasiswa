<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('produksis') && !Schema::hasTable('produksi')) {
            Schema::rename('produksis', 'produksi');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('produksi') && !Schema::hasTable('produksis')) {
            Schema::rename('produksi', 'produksis');
        }
    }
};