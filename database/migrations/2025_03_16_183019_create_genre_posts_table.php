<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('genre_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
           $table->enum('status', ['active', 'inactive'])->default('active');
             $table->enum('type', ['DANH SÁCH HƯỚNG DẪN CƠ BẢN', 'DANH SÁCH THỦ THUẬT KHÁC'])->default('DANH SÁCH HƯỚNG DẪN CƠ BẢN');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genre_posts');
    }
};
