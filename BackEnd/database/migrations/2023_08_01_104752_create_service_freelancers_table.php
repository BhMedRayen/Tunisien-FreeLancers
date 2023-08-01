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
        Schema::create('service_freelancers', function (Blueprint $table) {
            $table->id();
            $table->string("Name_Service");
            $table->integer("YearsBusiness");
            $table->string("TypeService");
            $table->integer("PrincesRange");
            $table->foreignId("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_freelancers');
    }
};
