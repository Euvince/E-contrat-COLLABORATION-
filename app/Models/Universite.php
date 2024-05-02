<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Wildside\Userstamps\Userstamps;

/**
 * @property integer $id
 * @property string $code
 * @property string $code_designation
 * @property string $nom
 * @property string $nom_designation
 * @property string $adresse
 * @property string $telephone
 * @property string $siteweb
 * @property string $email
 * @property string $recteur
 * @property string $comptable
 * @property string $ville
 * @property string $logo
 * @property string $slug
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Ufr[] $ufrs
 */
class Universite extends Model
{
    use HasFactory, Searchable, SoftDeletes, Sluggable, Userstamps;
    /**
     * @var array
     */
    protected $fillable = ['code', 'code_designation', 'nom', 'nom_designation', 'adresse', 'telephone', 'siteweb', 'email', 'recteur', 'comptable', 'ville', 'logo', 'slug', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ufrs()
    {
        return $this->hasMany('App\Models\Ufr');
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

    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->logo);
    }
}
