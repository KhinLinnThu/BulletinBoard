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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('email',255)->unique();
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->text('profile');
            $table->tinyInteger('role');
            $table->string('phone', 255)->nullable(true);
            $table->date('birthday')->nullable(true);
            $table->string('address',255)->nullable(true);
            $table->bigInteger('created_user_id')->default(1);
            $table->bigInteger('updated_user_id')->default(1);;
            $table->bigInteger('deleted_user_id')->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes()->nullable(true);
            $table->rememberToken();
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
