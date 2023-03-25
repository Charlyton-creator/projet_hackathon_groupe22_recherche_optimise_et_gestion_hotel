<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [];

    public function chambres(){
        return $this->hasMany(Chambre::class, 'reservations_chambres')->using(Reservation::class);
    }
    /**
     * 
     */
    public function requested_services(){
        return $this->hasMany(Service::class, 'demandes_services')->using(ClientService::class);
    }
}
