<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'structure', 'photo', 'type', 'nin', 'matricule', 'nom', 'prenom',
        'nom_ar', 'prenom_ar', 'nom_jeune_fille', 'nom_jeune_fille_ar',
        'civilite', 'presume', 'date_naissance', 'lieu_naissance',
        'lieu_naissance_ar', 'situation_familiale', 'nationalite',
        'service_national', 'groupe_sanguin', 'prenom_pere', 'prenom_pere_ar',
        'nom_mere', 'nom_mere_ar', 'prenom_mere', 'prenom_mere_ar',
        'date_recrutement', 'corps', 'grade', 'filiere', 'date_installation',
        'ssn', 'date_affiliation', 'type_compte', 'num_compte', 'date_effet',
        'echelon', 'categorie', 'position', 'rfid_card'
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
