<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('unit_kerjas', function (Blueprint $table) {
            //menentukkan unit kerja induk dari unit kerja ini.
            // null berarti unit kerja berada pada tingkat paling atas.

            $table->foreignID('parent_id')
            ->nullable()
            ->after('nama')
            ->constrained('unit_kerjas')
            ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit_kerjas', function (Blueprint $table) {
            //menghapus foreign key terlebih dulu
            $table->dropForeign(['parent_id']);

            //menghapus kolom parent_id
            $table->dropColumn('parent_id');
        });
    }
};
