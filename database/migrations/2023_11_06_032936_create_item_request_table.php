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
        Schema::create('item_request', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_no');
            $table->string('purpose_id');
            $table->string('category_id');
            $table->string('unit_id');
            $table->string('item_id');
            $table->string('item_cost');
            $table->string('qty');
            $table->string('total_cost');
            $table->string('status');
            $table->string('user_id');
            $table->string('off_id');
            $table->string('campid');
            $table->string('date_approve_pending');
            $table->rememberToken();
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
        Schema::dropIfExists('item_request');
    }
};
