<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // liên kết tới posts
            $table->string('file_path'); // đường dẫn file
            $table->enum('type', ['image', 'video']); // loại media
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_media');
    }
};
