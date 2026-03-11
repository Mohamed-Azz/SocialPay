<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class EmployeesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Conversion logic for Excel dates if needed
        $parseDate = function($value) {
            if (empty($value)) return null;
            try {
                return Carbon::parse($value);
            } catch (\Exception $e) {
                return null;
            }
        };

        return new Employee([
            'structure'          => $row['structure'] ?? null,
            'photo'              => $row['photo'] ?? null,
            'type'               => $row['type'] ?? null,
            'nin'                => $row['identifiant_nin'] ?? null,
            'matricule'          => $row['matricule'] ?? null,
            'nom'                => $row['nom'] ?? null,
            'prenom'             => $row['prenom'] ?? null,
            'nom_ar'             => $row['nom_arabe'] ?? null,
            'prenom_ar'          => $row['prenom_arabe'] ?? null,
            'nom_jeune_fille'    => $row['nom_de_jeune_fille'] ?? null,
            'nom_jeune_fille_ar' => $row['nom_de_jeune_fille_arabe'] ?? null,
            'civilite'           => $row['civilite'] ?? null,
            'presume'            => $row['presume'] ?? null,
            'date_naissance'     => $parseDate($row['date_de_naissance'] ?? null),
            'lieu_naissance'     => $row['lieu_naissance'] ?? null,
            'lieu_naissance_ar'  => $row['lieu_de_naissance_arabe'] ?? null,
            'situation_familiale'=> $row['situation_familiale'] ?? null,
            'nationalite'        => $row['nationalite'] ?? null,
            'service_national'   => $row['service_national'] ?? null,
            'groupe_sanguin'     => $row['groupe_sanguin'] ?? null,
            'prenom_pere'        => $row['prenom_du_pere'] ?? null,
            'prenom_pere_ar'     => $row['prenom_du_pere_arabe'] ?? null,
            'nom_mere'           => $row['nom_de_la_mere'] ?? null,
            'nom_mere_ar'        => $row['nom_de_la_mere_arabe'] ?? null,
            'prenom_mere'        => $row['prenom_de_la_mere'] ?? null,
            'prenom_mere_ar'     => $row['prenom_de_la_mere_arabe'] ?? null,
            'date_recrutement'   => $parseDate($row['date_recrutement'] ?? null),
            'corps'              => $row['corps'] ?? null,
            'grade'              => $row['grade'] ?? null,
            'filiere'            => $row['filiere'] ?? null,
            'date_installation'  => $parseDate($row['date_installation'] ?? null),
            'ssn'                => $row['no_securite_sociale'] ?? null,
            'date_affiliation'   => $parseDate($row['date_daffiliation'] ?? null),
            'type_compte'        => $row['type_compte'] ?? null,
            'num_compte'         => $row['no_compte'] ?? null,
            'date_effet'         => $parseDate($row['date_effet'] ?? null),
            'echelon'            => $row['echelon'] ?? null,
            'categorie'          => $row['categorie'] ?? null,
            'position'           => $row['position'] ?? null,
            'rfid_card'          => $row['carte_rfid'] ?? null,
        ]);
    }
}
