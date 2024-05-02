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
        Schema::create('programmations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ufr_id');
            $table->unsignedBigInteger('annee_id');
            $table->unsignedBigInteger('classe_id');
            $table->integer('semestre')->nullable();
            $table->string('code_ue')->nullable();
            $table->unsignedBigInteger('ue_id');
            $table->integer('credit')->nullable();
            $table->string('montant')->nullable();

            $table->unsignedBigInteger('contrat1_id')->nullable();
            $table->string('code_ecue1')->nullable();
            $table->unsignedBigInteger('ecue1')->nullable();
            $table->unsignedBigInteger('enseignant1')->nullable();
            $table->integer('heure_theorique1')->nullable();
            $table->integer('heure_execute1')->nullable();
            $table->integer('etat1')->default(0);
            $table->time('plage_debut1')->nullable();
            $table->time('plage_fin1')->nullable();
            $table->date('date_debut1')->nullable();
            $table->date('date_fin1')->nullable();
            $table->datetime('date_composition1')->nullable();
            $table->string('salle1')->nullable();

            $table->string('code_ecue2')->nullable();
            $table->unsignedBigInteger('contrat2_id')->nullable();
            $table->unsignedBigInteger('ecue2')->nullable();
            $table->unsignedBigInteger('enseignant2')->nullable();
            $table->integer('heure_theorique2')->nullable();
            $table->integer('heure_execute2')->nullable();
            $table->integer('etat2')->default(0);
            $table->time('plage_debut2')->nullable();
            $table->time('plage_fin2')->nullable();
            $table->date('date_debut2')->nullable();
            $table->date('date_fin2')->nullable();
            $table->datetime('date_composition2')->nullable();
            $table->string('salle2')->nullable();
            
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ufr_id')
                ->references('id')
                ->on('ufrs')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('classe_id')
                ->references('id')
                ->on('classes')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('annee_id')
                ->references('id')
                ->on('annees')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('ue_id')
                ->references('id')
                ->on('ues')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            
            $table->foreign('contrat1_id')
                ->references('id')
                ->on('contrats')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('contrat2_id')
                ->references('id')
                ->on('contrats')
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
        Schema::dropIfExists('programmations');
    }
};
