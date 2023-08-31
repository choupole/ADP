<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = ['proprietaire_id', 'user_id', 'parcelle_id', 'montant', 'datePaie'];

    public function attestations()
    {
        return $this->hasMany(Attestation::class);
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
}
