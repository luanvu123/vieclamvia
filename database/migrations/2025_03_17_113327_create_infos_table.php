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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('big_logo')->nullable();
            $table->string('small_logo')->nullable();
            $table->string('url_facebook')->nullable();
            $table->text('notice')->nullable();
            $table->text('notice_modal')->nullable();
            $table->text('warranty_policy_success')->nullable();
            $table->text('warranty_policy_error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};
