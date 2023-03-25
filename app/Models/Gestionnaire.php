<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Gestionnaire extends Authenticatable
{
    use HasFactory;
    protected $table = "gestionnaires";
    protected $fillable = [];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
    /**
     * 
     */
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
