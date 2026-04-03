<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('address');
            $table->string('city')->default('Almaty');
            $table->integer('rooms')->default(1);
            $table->integer('roommates_needed')->default(1);
            $table->enum('type', ['looking_for_room', 'offering_room']);
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive', 'closed'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
