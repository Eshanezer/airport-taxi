<?php

use App\Models\Invoice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('refno');
            $table->string('driver');
            $table->string('representative');
            $table->string('passenger')->nullable();
            $table->string('passport')->nullable();
            $table->string('remark')->nullable();
            $table->date('date');
            $table->integer('pax')->default(1);
            $table->integer('waiting')->default(0);
            $table->integer('extrakm')->default(0);
            $table->double('kmtotal');
            $table->double('extrakmtotal');
            $table->double('waitingtotal');
            $table->double('driver_total');
            $table->double('journey_total');
            $table->double('grand_total');
            $table->double('discount_total');
            $table->string('dcc');
            $table->enum('status', array_keys(Invoice::$status))->default(1);

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
        Schema::dropIfExists('invoices');
    }
}
