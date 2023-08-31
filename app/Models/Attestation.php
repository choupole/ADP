<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcelle_id',
        'paiement_id',
        'dateED',
        'dateREM',
        'user_id',
    ];

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
