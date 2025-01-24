<?php

namespace App\Models;

use App\Http\Controllers\SuscripcionController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'email', 'metodo_pago'];

    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class);
    }
    


}
