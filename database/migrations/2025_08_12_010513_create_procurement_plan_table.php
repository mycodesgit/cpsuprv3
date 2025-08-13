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
        Schema::create('procurement_plan', function (Blueprint $table) {
            $table->id();
            $table->integer('pryearid');
            $table->string('pryearname');
            $table->integer('pruserid');
            $table->string('prusercampus');
            $table->timestamps();
        });

        // Child table - each row in the form
        Schema::create('procurement_plan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('procurement_plan')->onDelete('cascade');
            $table->string('planyearname')->nullable();
            $table->string('code')->nullable(); // Expense Account Code
            $table->string('pap')->nullable(); // Program/Project/Activity
            $table->text('general_description');
            $table->string('quantity_size')->nullable();
            $table->decimal('estimated_budget', 15, 2)->nullable();
            $table->string('mode_of_procurement')->nullable();

            // Month markers (store "X" or NULL)
            $table->char('jan', 1)->nullable();
            $table->char('feb', 1)->nullable();
            $table->char('mar', 1)->nullable();
            $table->char('apr', 1)->nullable();
            $table->char('may', 1)->nullable();
            $table->char('jun', 1)->nullable();
            $table->char('jul', 1)->nullable();
            $table->char('aug', 1)->nullable();
            $table->char('sep', 1)->nullable();
            $table->char('oct', 1)->nullable();
            $table->char('nov', 1)->nullable();
            $table->char('dec', 1)->nullable();

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
        Schema::dropIfExists('procurement_plan');
    }
};
