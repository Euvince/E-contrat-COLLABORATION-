<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Wildside\Userstamps\Userstamps;

/**
 * @property Ufr $ufr
 */
class User extends Authenticatable
{
    use HasRoles, Notifiable, HasFactory, Searchable, SoftDeletes, Sluggable, Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'avatar', 'ufr_id', 'departement_id','classe_id', 'telephone', 'sexe',
        'slug', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullnameAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['nom', 'prenom']
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ufr()
    {
        return $this->belongsTo('App\Models\Ufr');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }
}
