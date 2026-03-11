<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('structure')->nullable();
            $table->string('photo')->nullable();
            $table->string('type')->nullable();
            $table->string('nin', 20)->nullable(); // Identifiant : NIN
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('nom_ar')->nullable();
            $table->string('prenom_ar')->nullable();
            $table->string('nom_jeune_fille')->nullable();
            $table->string('nom_jeune_fille_ar')->nullable();
            $table->string('civilite')->nullable();
            $table->string('presume')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('lieu_naissance_ar')->nullable();
            $table->string('situation_familiale')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('service_national')->nullable();
            $table->string('groupe_sanguin')->nullable();
            $table->string('prenom_pere')->nullable();
            $table->string('prenom_pere_ar')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('nom_mere_ar')->nullable();
            $table->string('prenom_mere')->nullable();
            $table->string('prenom_mere_ar')->nullable();
            $table->date('date_recrutement')->nullable();
            $table->string('corps')->nullable();
            $table->string('grade')->nullable();
            $table->string('filiere')->nullable();
            $table->date('date_installation')->nullable();
            $table->string('ssn', 12)->unique(); // N° sécurité sociale
            $table->date('date_affiliation')->nullable();
            $table->string('type_compte')->nullable();
            $table->string('num_compte')->nullable();
            $table->date('date_effet')->nullable();
            $table->string('echelon')->nullable();
            $table->string('categorie')->nullable();
            $table->string('position')->nullable();
            $table->string('rfid_card')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
