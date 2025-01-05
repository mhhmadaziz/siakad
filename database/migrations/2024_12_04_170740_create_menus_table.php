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
        /*menu status*/
        Schema::create('menu_statuses', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->timestamps();
        });

        /*lokasi menu*/
        Schema::create('menu_locations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->timestamps();
        });

        /*menus*/
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->string('label');
            $table->string('route')->nullable();
            $table->string('icon')->nullable();
            $table->string('role')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('menus');
            $table->foreignId('menu_status_id')->constrained('menu_statuses');
            $table->foreignId('menu_location_id')->constrained('menu_locations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_statuses');
        Schema::dropIfExists('menu_locations');
        Schema::dropIfExists('menus');
    }
};
