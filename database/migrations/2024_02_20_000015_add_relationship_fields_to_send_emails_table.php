<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSendEmailsTable extends Migration
{
    public function up()
    {
        Schema::table('send_emails', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9517617')->references('id')->on('users');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id', 'contact_fk_9517611')->references('id')->on('contacts');
            $table->unsignedBigInteger('email_template_id')->nullable();
            $table->foreign('email_template_id', 'email_template_fk_9517612')->references('id')->on('email_templates');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9517616')->references('id')->on('teams');
        });
    }
}
