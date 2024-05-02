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
        Schema::create('ufrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('code_designation')->nullable();
            $table->string('nom')->nullable();
            $table->string('nom_designation')->nullable();
            $table->string('lieu')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('siteweb')->nullable();
            $table->string('email')->nullable();
            $table->string('directeur')->nullable();
            $table->string('appellation_directeur')->nullable();
            $table->string('da')->nullable();
            $table->string('appellation_da')->nullable();
            $table->string('ville')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('universite_id');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('universite_id')
                ->references('id')
                ->on('universites')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ufrs');
    }
};
