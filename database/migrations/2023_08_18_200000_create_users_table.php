<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('UsersUlid')->primary();
            $table->string('username',255);
            $table->string('email')->unique()->index();
            $table->string('password',1000);
            $table->ulid('RoleUlid')->index();
            $table->foreign('RoleUlid')->references('RoleUlid')->on('role');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
