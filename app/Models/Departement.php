<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

use Wildside\Userstamps\Userstamps;

/**
 * @property integer $id
 * @property integer $ufr_id
 * @property string $code
 * @property string $nom
 * @property string $logo
 * @property string $slug
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Ufr $ufr
 * @property Filiere[] $filieres
 * @property User[] $users
 */
class Departement extends Model
{
    use HasFactory, Searchable, SoftCascadeTrait, SoftDeletes, Sluggable, Userstamps;
    /**
     * @var array
     */
    protected $fillable = ['ufr_id', 'code', 'nom', 'logo', 'slug', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $softCascade = ['filieres'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ufr()
    {
        return $this->belongsTo('App\Models\Ufr');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function filieres()
    {
        return $this->hasMany('App\Models\Filiere');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
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
