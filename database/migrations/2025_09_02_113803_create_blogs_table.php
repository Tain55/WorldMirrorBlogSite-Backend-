<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');

        // optional useful fields
        $table->string('slug')->unique(); // title থেকে slug তৈরি হবে (url friendly)
        $table->string('image')->nullable(); // blog এর thumbnail / image
        $table->boolean('is_published')->default(false); // draft or published

        // relation
        $table->unsignedBigInteger('user_id'); // যেই user blog লিখেছে
        $table->unsignedBigInteger('category_id'); // category টেবিলের সাথে relation
        
        // Foreign key constraint
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
