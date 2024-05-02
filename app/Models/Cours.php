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
 * @property integer $classe_id
 * @property integer $ue_id
 * @property integer $ecue1
 * @property integer $enseignant1
 * @property integer $ecue2
 * @property integer $enseignant2
 * @property integer $semestre
 * @property integer $credit
 * @property integer $heure_theorique
 * @property string $slug
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Classe $class
 * @property Ecue $ecue
 * @property Enseignant $enseignant
 * @property Ue $ue
 */
class Cours extends Model
{
    use HasFactory, Searchable, SoftDeletes, Sluggable, Userstamps;
    /**
     * @var array
     */
    protected $fillable = ['classe_id', 'ue_id', 'ecue1', 'enseignant1', 'ecue2', 'enseignant2', 'semestre', 'credit', 'heure_theorique1','heure_theorique2', 'slug', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

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
