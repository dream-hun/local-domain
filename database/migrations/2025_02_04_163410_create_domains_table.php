<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tld');
            $table->string('status'); // registered, pending, expired, etc.
            $table->dateTime('registration_date')->nullable();
            $table->dateTime('expiration_date')->nullable();
            $table->string('auth_info')->nullable(); // EPP auth info
            $table->unsignedBigInteger('registrant_contact_id');
            $table->unsignedBigInteger('technical_contact_id');
            $table->unsignedBigInteger('admin_contact_id')->nullable();
            $table->unsignedBigInteger('billing_contact_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('registrant_contact_id')->references('id')->on('contacts');
            $table->foreign('technical_contact_id')->references('id')->on('contacts');
            $table->foreign('admin_contact_id')->references('id')->on('contacts');
            $table->foreign('billing_contact_id')->references('id')->on('contacts');

            $table->unique(['name', 'tld']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
