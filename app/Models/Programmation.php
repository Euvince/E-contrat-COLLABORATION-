<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Wildside\Userstamps\Userstamps;

/**
 * @property integer $id
 * @property integer $contra1_id
 * @property integer $contrat2_id
 * @property integer $annee_id
 * @property integer $enseignant_id
 * @property integer $ue_id
 * @property integer $ecue1
 * @property integer $enseignant1
 * @property integer $ecue2
 * @property integer $enseignant2
 * @property integer $semestre
 * @property integer $heure_theorique1
 * @property integer $heure_execute1
 * @property string $plage_debut1
 * @property string $plage_fin1
 * @property string $date_debut1
 * @property string $date_fin1
 * @property integer $etat1
 * @property integer $heure_theorique2
 * @property integer $heure_execute2
 * @property string $plage_debut2
 * @property string $plage_fin2
 * @property string $date_debut2
 * @property string $date_fin2
 * @property integer $etat2
 * @property string $montant
 * @property string $date_composition1
 * @property string $date_composition2
 * @property string $slug
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Cahier[] $cahiers
 * @property Annee $annee
 * @property Ecue $ecue
 * @property Enseignant $enseignant
 * @property Contrat $contrat1
 * @property Contrat $contrat2
 * @property Ue $ue
 */
class Programmation extends Model
{
    use HasFactory, Searchable, SoftDeletes, Sluggable, Userstamps;
    /**
     * @var array
     */
    protected $fillable = ['contrat_id', 'annee_id', 'classe_id', 'ue_id', 'ecue1', 'enseignant1', 'ecue2', 'enseignant2', 'semestre', 'heure_theorique1', 'heure_theorique2', 'heure_execute1','heure_execute1','salle1', 'salle2', 'date_debut1', 'date_fin1', 'etat1','date_debut2', 'date_fin2', 'etat2', 'montant', 'date_composition1','date_composition2', 'slug', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cahiers()
    {
        return $this->hasMany('App\Models\Cahier');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function annee()
    {
        return $this->belongsTo('App\Models\Annee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classe()
    {
        return $this->belongsTo('App\Models\Classe', 'classe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ecue1()
    {
        return $this->belongsTo('App\Models\Ecue', 'ecue1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant1()
    {
        return $this->belongsTo('App\Models\Enseignant', 'enseignant1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contrat1()
    {
        return $this->belongsTo('App\Models\Contrat','contrat1_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contrat2()
    {
        return $this->belongsTo('App\Models\Contrat','contrat2_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ecue2()
    {
        return $this->belongsTo('App\Models\Ecue', 'ecue2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant2()
    {
        return $this->belongsTo('App\Models\Enseignant', 'enseignant2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ue()
    {
        return $this->belongsTo('App\Models\Ue');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nom'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
