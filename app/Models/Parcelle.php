<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    use HasFactory;

    protected $fillable = [
        'proprietaire_id',
        'category_id',
        'numACP',
        'numeroPar',
        'avenue',
        'quartier',
        'commune',
        'dateED',
    ];

    public function attestations()
    {
        return $this->hasMany(Attestation::class);
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
