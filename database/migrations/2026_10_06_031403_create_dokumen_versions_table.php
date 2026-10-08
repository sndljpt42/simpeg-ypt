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
        Schema::create('dokumen_versions', function (Blueprint $table) {
            $table->id();
            //Satu version harus selalu memiliki dokumen induk.
            $table->foreignId('dokumen_id')
                ->constrained('dokumens')
                ->cascadeOnDelete();

            $table->unsignedInteger('version');
            $table->string('nama_file');
            $table->string('path');
            $table->string('mime_type');
            $table->unsignedBigInteger('ukuran');

           
            $table->string('checksum', 64)->nullable();

            $table->timestamps();
            
             //satu dokumen tidak mempunyai dua Version 1, dua Version 2, dan seterusnya.
            $table->unique(['dokumen_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_versions');
    }
};
