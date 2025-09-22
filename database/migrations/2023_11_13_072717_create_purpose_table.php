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
        Schema::create('purpose', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('camp_id');
            $table->string('office_id');
            $table->string('transaction_no');
            $table->string('pr_no');
            $table->enum('type_request', ['1'])->default('1');
            $table->integer('cat_id')->nullable();
            $table->string('purpose_name');
            $table->enum('pstatus', ['1','2','3','4','5','6','7','8','9'])->default('1');
            $table->string('datetech')->nullable();
            $table->string('dateproc')->nullable();
            $table->string('datebud')->nullable();
            $table->string('datereceived')->nullable();
            $table->string('datecanvassing')->nullable();
            $table->string('datecanvassed')->nullable();
            $table->string('datephilgeps')->nullable();
            $table->string('dateposted')->nullable();
            $table->string('datebidding')->nullable();
            $table->string('dateconsolidate')->nullable();
            $table->string('dateawarded')->nullable();
            $table->string('datepurchase')->nullable();
            $table->string('datereturned')->nullable();
            $table->string('dateforwarded')->nullable();
            $table->string('datecancel')->nullable();
            $table->string('officeidreturn');
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
        Schema::dropIfExists('purpose');
    }
};
