<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('filter_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->json('filters');
            $table->timestamp('applied_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('filter_logs');
    }
};
