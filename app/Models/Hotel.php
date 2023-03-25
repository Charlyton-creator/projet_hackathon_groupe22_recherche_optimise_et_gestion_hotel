<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public function chambres(){
        return $this->hasMany(Chambre::class);
    }
    /**
     * 
     */
    public function services(){
        return $this->hasMany(Service::class);
    }
    /**
     * 
     */
    public function gestionnaire(){
        return $this->hasOne(Gestionnaire::class);
    }
}
