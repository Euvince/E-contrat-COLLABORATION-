<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

/**
 * @property integer $id
 * @property string $slug
 * @property string $nom
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Status extends Model
{
    /**
     * @var array
     */
    use Sluggable, SoftDeletes, Searchable, HasFactory, Userstamps;

    protected $fillable = ['slug', 'nom', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    public function sluggable(): array
    {
        return ['slug' => [
            'source' => 'nom'
        ]];
    }

    public function enseignants()
    {
        return $this->hasMany(Enseignant::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
