<?php

use App\Models\Driver;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('turnno');

            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('nic');

            $table->text('address1');
            $table->text('address2')->nullable();
            $table->string('city');

            $table->string('tp1');
            $table->string('tp2')->nullable();

            $table->string('license_number');
            $table->date('license_date');
            $table->date('joining_date');
            $table->string('vehicle_number');

            $table->enum('status', array_keys(Driver::$status))->default(1);
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
        Schema::dropIfExists('drivers');
    }
}
