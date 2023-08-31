<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function proprietaires()
    {
        return $this->belongsToMany(Proprietaire::class, 'nationality_proprietaire');
    }
}
