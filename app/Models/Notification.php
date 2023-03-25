<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notifications";
    protected $fillable = [];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    /**
     * 
     */
    public function gestionnaire(){
        return $this->belongsTo(Gestionnaire::class);
    }
}
