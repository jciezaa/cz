<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;


    protected $fillable = ['nombre', 'precio', 'periodicidad'];

    public function suscripciones()
{
    return $this->hasMany(Suscripcion::class);
}



}
