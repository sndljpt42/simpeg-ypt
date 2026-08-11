<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan role untuk membedakan hak akses setiap user.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Role digunakan untuk menentukan hak akses user.
            // Default operator agar user lama tetap memiliki role yang valid.
            $table->string('role')->default('operator')->after('email');
        });
    }

    /**
     * Menghapus kolom role jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};