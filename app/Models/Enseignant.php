<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $grade_id
 * @property integer $banque_id
 * @property integer $status_id
 * @property string $npi
 * @property string $civilite
 * @property string $nom
 * @property string $prenoms
 * @property string $adresse
 * @property string $telephone
 * @property string $compte
 * @property string $ifu
 * @property string $nationalite
 * @property string $sexe
 * @property string $email
 * @property string $profession
 * @property string $date_naissance
 * @property string $slug
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $lieu_naissance
 * @property string $structure_origine
 * @property string $corps_cames
 * @property string $annee_inscription_cames
 * @property string $premiere_annee_collaboration
 * @property string $corps_fonction_publique
 * @property string $grade
 * @property string $indice
 * @property integer $nb_enfants
 * @property string $poste_administratif
 * @property string $date_prise_service
 * @property string $diplome_recrutement
 * @property string $specialite_diplome_recrutement
 * @property string $diplome_actuel
 * @property string $specialite_diplome_actuel
 * @property Contrat[] $contrats
 * @property Cour[] $cours
 * @property Banque $banque
 * @property Status $status
 * @property Exercer[] $exercers
 * @property Programmation[] $programmations
 */
class Enseignant extends Model
{
    use SoftDeletes, Sluggable;
    /**
     * @var array
     */
    protected $fillable = ['grade_id', 'banque_id', 'status_id', 'npi', 'civilite', 'nom', 'prenoms', 'adresse', 'telephone', 'compte', 'ifu', 'nationalite', 'sexe', 'email', 'profession', 'date_naissance', 'slug', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'lieu_naissance', 'structure_origine', 'corps_cames', 'annee_inscription_cames', 'premiere_annee_collaboration', 'corps_fonction_publique', 'grade', 'indice', 'nb_enfants', 'poste_administratif', 'date_prise_service', 'diplome_recrutement', 'specialite_diplome_recrutement', 'diplome_actuel', 'specialite_diplome_actuel'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contrats()
    {
        return $this->hasMany('App\Models\Contrat');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cours1()
    {
        return $this->hasMany('App\Models\Cour', 'enseignant2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cours2()
    {
        return $this->hasMany('App\Models\Cour', 'enseignant1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function banque()
    {
        return $this->belongsTo('App\Models\Banque');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exercer()
    {
        return $this->hasMany('App\Models\Exercer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programmations1()
    {
        return $this->hasMany('App\Models\Programmation', 'enseignant2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programmations2()
    {
        return $this->hasMany('App\Models\Programmation', 'enseignant1');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'npi',
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
