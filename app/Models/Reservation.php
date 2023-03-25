<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relationship\Pivot;

class Reservation extends Pivot
{
    use HasFactory;
    protected $table = "reservations_chambres";

    protected $fillable = [];

    public $incrementing = true;
}
