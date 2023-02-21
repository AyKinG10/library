<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img');
            $table->string('pdf');
            $table->string('author');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('books');
    }
};
