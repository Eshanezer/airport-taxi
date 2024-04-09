<?php

use App\Models\Pricing;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->integer('start');
            $table->integer('end');
            $table->integer('route')->nullable();
            $table->integer('vehicletype');
            $table->double('journey_price');
            $table->double('driver_price');
            $table->double('km')->nullable();
            $table->double('extra')->default(0);
            $table->double('waiting')->default(0);
            $table->enum('status', array_keys(Pricing::$status))->default(1);
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
        Schema::dropIfExists('pricings');
    }
}
