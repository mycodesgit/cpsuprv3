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
        Schema::create('papspre_plan', function (Blueprint $table) {
            $table->id();
            $table->integer('papsyearid');
            $table->string('papsyearname');
            $table->integer('papsuserid');
            $table->string('papsusercampus');
            $table->string('papsuserfundsource');
            $table->timestamps();
        });

        Schema::create('paspre_plan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('papspreplan_id')->constrained('procurement_plan')->onDelete('cascade');
            $table->string('papspreplanyearname')->nullable();
            $table->string('ppa_cat')->nullable();
            $table->string('ppa')->nullable();
            $table->string('papsprecode')->nullable(); // Expense Account Code
            $table->string('papstitle')->nullable();
            $table->text('papsamount')->nullable();
            $table->string('papsprocyn')->nullable();
            $table->string('papsresperson')->nullable();
            $table->string('papsevidences')->nullable();

            // Month markers (store "X" or NULL)
            $table->string('jan')->nullable();
            $table->string('feb')->nullable();
            $table->string('mar')->nullable();
            $table->string('apr')->nullable();
            $table->string('may')->nullable();
            $table->string('jun')->nullable();
            $table->string('jul')->nullable();
            $table->string('aug')->nullable();
            $table->string('sep')->nullable();
            $table->string('oct')->nullable();
            $table->string('nov')->nullable();
            $table->string('dec')->nullable();

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
        Schema::dropIfExists('papspre_plan');
    }
};
