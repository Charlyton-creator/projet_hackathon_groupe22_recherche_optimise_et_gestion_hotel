<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relathionship\Pivot;

class ClientService extends Pivot
{
    use HasFactory;
    protected $table = "demandes_services";

    protected $fillable = [];

    public $incrementing = true;
}
