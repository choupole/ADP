<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proprietaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =
    [
        'nom',  'postnom', 'sexe',
    'prenom', 'numeroPar', 'avenue', 'quartier', 'commune'];

    protected $dates = ['deleted_at'];

    public function nationalities()
    {
        return $this->belongsToMany(Nationality::class, 'nationality_proprietaire');
    }

    public function hasNationalities(array $nationalities)
    {
        return $this->nationalities()->whereIn('name', $nationalities)->exists();
    }

    public function parcelles()
    {
        return $this->hasMany(Parcelle::class);
    }
}
