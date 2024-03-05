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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('region')->nullable(); // abidjan, sassandra
            $table->string('zone')->nullable(); //cocody, adzope
            // $table->integer('parent_id')->nullable(); //cocody, adzope
            $table->double('tarif')->nullable();

            $table->foreignId('region_id')
                ->nullable()
                ->constrained('deliveries')
                ->onUpdate('cascade')
                ->onDelete('set null');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
