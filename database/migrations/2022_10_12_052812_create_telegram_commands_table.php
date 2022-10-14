<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *создание таблицы телеграм команды
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_commands', function (Blueprint $table) {
            $table->id();
            $table->string('command');
            $table->string('context');
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
        Schema::dropIfExists('telegram_commands');
    }
};
