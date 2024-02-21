<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->datetime('meeting_date');
            $table->string('budget');
            $table->string('number_of_bedrooms');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
