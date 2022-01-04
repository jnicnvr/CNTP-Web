<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passes', function (Blueprint $table) {
            $table->id();
            $table->string('qr')->unique();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->string('sex');
            $table->string('birthday');
            $table->string('address');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('occupation');
            $table->string('workplace');

            $table->string('purpose');
            $table->string('travel_details');
            // $table->string('origin');
            $table->string('po_street');
            $table->string('po_brgy');
            $table->string('po_municipality');
            $table->string('po_province');
            
            $table->string('pd_street');
            $table->string('pd_brgy');
            $table->string('pd_municipality');
            $table->string('pd_province');
            // $table->string('pd_province')->nullable()->default('Camarines Norte');
            $table->string('vehicle');
            $table->string('plate_no');
            $table->string('classification');
            $table->timestamp('booked_date');

            $table->string('attachment1')->nullable()->default('no_image1');
            $table->string('attachment2')->nullable()->default('no_image2');
            $table->string('status')->nullable()->default('Not Yet Evaluated');
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
        Schema::dropIfExists('passes');
    }
}
