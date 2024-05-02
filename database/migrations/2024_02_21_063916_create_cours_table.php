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
        Schema::create('cours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('classe_id');
            $table->integer('semestre');

            $table->string('code_ue')->nullable();
            $table->unsignedBigInteger('ue_id');
            $table->integer('credit');

            $table->string('code_ecue1')->nullable();
            $table->unsignedBigInteger('ecue1')->nullable();
            $table->unsignedBigInteger('enseignant1')->nullable();
            $table->integer('heure_theorique1')->nullable();

            $table->string('code_ecue2')->nullable();
            $table->unsignedBigInteger('ecue2')->nullable();
            $table->unsignedBigInteger('enseignant2')->nullable();
            $table->integer('heure_theorique2')->nullable();

            $table->string('slug')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('classe_id')
                ->references('id')
                ->on('classes')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            
            $table->foreign('ue_id')
                ->references('id')
                ->on('ues')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('ecue1')
                ->references('id')
                ->on('ecues')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('enseignant1')
                ->references('id')
                ->on('enseignants')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            
            $table->foreign('ecue2')
                ->references('id')
                ->on('ecues')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            
            $table->foreign('enseignant2')
                ->references('id')
                ->on('enseignants')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseigner');
    }
};
