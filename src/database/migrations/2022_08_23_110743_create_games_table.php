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
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60);
            $table->string('memo', 255)->nullable()->default(null);
            $table->foreignId('user_id')->constrained('users');
            $table->tinyInteger('hardware_type')->nullable()->default(null);
            $table->tinyInteger('status_id')->nullable()->default(null);
            $table->date('start_at')->nullable()->default(null);
            $table->date('end_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
