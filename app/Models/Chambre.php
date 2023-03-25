<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;
    protected $table = "chambres";
    protected $fillable = [];

    public function equipements(){
        return $this->hasMany(Equipement::class);
    }

    /**
     * hotel
     */
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
}
