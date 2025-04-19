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
        Schema::create('reserv_sugests', function (Blueprint $table) {
            $table->foreignId('reserv_id')->constrained()->onDelete('cascade');
            $table->foreignId('sugest_id')->constrained()->onDelete('cascade');
            $table->primary(['reserv_id', 'sugest_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserv_sugests');
    }
};
