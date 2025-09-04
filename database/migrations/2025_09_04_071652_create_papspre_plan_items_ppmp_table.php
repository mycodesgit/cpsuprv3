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
        Schema::create('papspre_plan_items_ppmp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('papspreplanid');
            $table->foreignId('papspreplanitemsid');
            $table->string('quantity_size')->nullable();
            $table->string('mode_of_procurement')->nullable();
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
        Schema::dropIfExists('papspre_plan_items_ppmp');
    }
};
