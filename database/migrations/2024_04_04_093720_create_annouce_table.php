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
        Schema::create('annouce', function (Blueprint $table) {
            $table->id();
            $table->text('announcement')->nullable();
            $table->date('datestart')->nullable();
            $table->date('dateend')->nullable();
            $table->enum('status', array(1, 2))->default(1);
            $table->timestamps();
        });

        DB::table('annouce')->insert([
            ['announcement' => 'Sample', 'datestart' => null, 'dateend' => null, 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annouce');
    }
};
