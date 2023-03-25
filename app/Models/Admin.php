<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "admins";
    protected $fillable = ['email', 'password'];
    
    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    /**
     * gestionnaires
     */
    public function gestionnaires(){
        return $this->hasMany(Gestionnaire::class);
    }
}
