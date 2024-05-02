<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $enseignant_id
 * @property integer $ufr_id
 * @property integer $annee_id
 * @property integer $cycle_id
 * @property string $numero
 * @property string $date_contrat
 * @property string $fichier
 * @property string $slug
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Annee $annee
 * @property Ufr $ufr
 * @property Cycle $cycle
 * @property Enseignant $enseignant
 * @property Cour[] $cours
 */
class Contrat extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['date_contrat', 'enseignant_id', 'cycle_id', 'ufr_id', 'annee_id', 'numero', 'fichier', 'slug', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

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
    public function cycle()
    {
        return $this->belongsTo('App\Models\Cycle');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ufr()
    {
        return $this->belongsTo('App\Models\Ufr');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant()
    {
        return $this->belongsTo('App\Models\Enseignant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cours()
    {
        return $this->hasMany('App\Models\Cour');
    }
}
