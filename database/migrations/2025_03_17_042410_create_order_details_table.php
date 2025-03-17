<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->uuid('uuid');
            $table->string('value');
            $table->enum('status', ['success', 'error', 'warranty'])->default('success');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
