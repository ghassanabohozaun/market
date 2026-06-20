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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->text('details')->nullable();
            $table->string('url')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('details_status')->default(true);
            $table->boolean('button_status')->default(true);
            $table->boolean('status')->default(true);
            $table->string('photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
