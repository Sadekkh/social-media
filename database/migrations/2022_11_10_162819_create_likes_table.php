<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("post_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('likes');
    }
};
