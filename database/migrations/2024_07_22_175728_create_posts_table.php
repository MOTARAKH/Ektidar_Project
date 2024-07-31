<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Preferred for auto-incrementing primary keys
            $table->string('title'); // Title of the post
            $table->string('side'); // Side related to the post
            $table->string('sidesParticipating'); // Sides participating in the post
            $table->timestamps(); // Created at and updated at timestamps
            $table->foreignId('user_id') // Define user_id as a foreign key
                ->constrained() // Automatically references the 'id' column on 'users'
                ->onDelete('cascade'); // Automatically delete posts when the user is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
