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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('npi')->nullable()->unique();;
            $table->string('civilite')->nullable();
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->unsignedBigInteger('banque_id')->nullable();
            $table->string('compte')->nullable();
            $table->string('ifu')->nullable()->unique();;
            $table->string('nationalite')->nullable();
            $table->string('sexe')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
            $table->date('date_naissance')->nullable();

            $table->string('lieu_naissance')->nullable();
            $table->foreignId('status_id')->nullable()->constrained('statuses')->onDelete('set null');
            $table->string('structure_origine')->nullable();
            $table->string('corps_cames')->nullable();
            $table->string('annee_inscription_cames')->nullable();
            $table->string('premiere_annee_collaboration')->nullable();
            $table->string('corps_fonction_publique')->nullable();
            $table->string('grade')->nullable();
            $table->string('indice')->nullable();
            $table->integer('nb_enfants')->default(0);
            $table->string('poste_administratif')->nullable();
            $table->string('date_prise_service')->nullable();
            $table->string('diplome_recrutement')->nullable();
            $table->string('specialite_diplome_recrutement')->nullable();
            $table->string('diplome_actuel')->nullable();
            $table->string('specialite_diplome_actuel')->nullable();

            $table->string('slug')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('banque_id')
                ->references('id')
                ->on('banques')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};
