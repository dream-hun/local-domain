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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_id')->unique(); // EPP Contact ID
            $table->string('type'); // registrant, technical, admin, billing
            $table->string('names');
            $table->string('org')->nullable();
            $table->string('street1');
            $table->string('street2')->nullable();
            $table->string('street3')->nullable();
            $table->string('city');
            $table->string('sp'); // state/province
            $table->string('pc'); // postal code
            $table->string('cc'); // country code
            $table->string('voice');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('password')->nullable(); // EPP auth info
            $table->boolean('voice_disclosed')->default(false);
            $table->boolean('email_disclosed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
