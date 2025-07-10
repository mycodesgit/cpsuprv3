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
        Schema::create('prnotification', function (Blueprint $table) {
            $table->id();
            $table->string('purp_id');
            $table->string('user_id');
            $table->text('message');
            $table->enum('notifstatus', ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'])->default('20');
            $table->boolean('is_read')->default(false);
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
        Schema::dropIfExists('prnotification');
    }
};
