<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId("account_id")->constrained("accounts");
            $table->decimal("amount");
            $table->string("image", 255);
            $table->boolean("approve")->nullable();
            $table->foreignId("user_id_approved")->nullable()->constrained("users");
            $table->foreignId("user_id_denied")->nullable()->constrained("users");
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
        Schema::dropIfExists('deposits');
    }
}
