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
        Schema::create('funding_source', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('camp_id');
            $table->string('office_id');
            $table->string('transaction_no')->nullable();
            $table->string('financing_source')->nullable();
            $table->string('fund_cluster')->nullable();
            $table->string('fund_category')->nullable();
            $table->string('fund_auth')->nullable();
            $table->string('specific_fund')->nullable();
            $table->text('reasons')->nullable();
            $table->string('allotment')->nullable();
            $table->string('mooe_amount')->nullable();
            $table->string('co_amount')->nullable();
            $table->text('account_code')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('funding_source');
    }
};
