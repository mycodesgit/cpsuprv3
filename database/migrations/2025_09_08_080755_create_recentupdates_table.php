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
        Schema::create('recentupdates', function (Blueprint $table) {
            $table->id();
            $table->text('otherannouncement')->nullable();
            $table->string('postedby')->nullable();
            $table->enum('status', array(1, 2))->default(1);
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
        Schema::dropIfExists('recentupdates');
    }
};
