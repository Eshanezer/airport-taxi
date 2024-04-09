<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_pricings', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice');
            $table->integer('start');
            $table->integer('end');
            $table->integer('route')->nullable();
            $table->integer('vehicletype');
            $table->double('discount');
            $table->double('journey_price');
            $table->double('driver_price');
            $table->double('km')->nullable();
            $table->double('extra')->default(0);
            $table->double('waiting')->default(0);
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
        Schema::dropIfExists('invoice_pricings');
    }
}
