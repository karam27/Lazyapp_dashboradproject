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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('caregivers_id')->nullable();
            $table->foreign('caregivers_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('set null');
            $table->date('birth_date')->nullable();
            $table->enum('weak_eye', ['left', 'right', 'both'])->nullable();
            $table->text('other_details')->nullable();
            $table->string('name');
            $table->decimal('vision_level', 5, 2)->nullable()->check('vision_level <= 5');
            $table->date('last_exam_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');

    }
};
