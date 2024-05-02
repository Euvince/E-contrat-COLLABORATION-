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
        Schema::create('cahiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('programmation_id');
            $table->unsignedBigInteger('ecue_id');
            $table->date('date')->nullable();
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            $table->float('duree')->nullable();
            $table->longText('libelles')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('programmation_id')
                ->references('id')
                ->on('programmations')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('ecue_id')
                ->references('id')
                ->on('ecues')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cahiers');
    }
};
