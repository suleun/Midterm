<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('image');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->year('year');
            $table->unsignedDecimal('price', $precision=10, $scale= 2);
            $table->string('type'); // 차종
            $table->string('style'); // 외형
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
