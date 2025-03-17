<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_customer_id')->nullable()->constrained()->onDelete('set null'); // Liên kết với bảng type_customers
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->boolean('is2Fa')->default(false);
            $table->string('google2fa_secret')->nullable();
            $table->string('idCustomer')->unique();
            $table->decimal('Balance', 15, 2)->default(0);
            $table->boolean('isOnline')->default(false);
            $table->string('google_id')->nullable();
            $table->rememberToken()->nullable();
            $table->enum('Status', ['active', 'inactive', 'banned'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
