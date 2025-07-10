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
        Schema::create('ppmpverify', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('camp_id');
            $table->string('office_id');
            $table->string('purpose_id');
            $table->text('ppmp_remarks')->nullable();
            $table->enum('prstatus', ['1','2'])->nullable();
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
        Schema::dropIfExists('ppmpverify');
    }
};
