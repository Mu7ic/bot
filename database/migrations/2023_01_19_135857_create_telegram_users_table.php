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
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('telegram_id')->comment('Телеграм id')->nullable();
            $table->char('surname', 50)->comment('Фамилия');
            $table->char('name', 50)->comment('Имя');
            $table->char('pname', 50)->comment('Отчество');
            $table->date('birthdate')->comment('Дата рождения');
            $table->date('citizenship')->comment('Гражданство');
            $table->timestamps();

            $table->index(['telegram_id', 'surname', 'name', 'pname']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_users');
    }
};
