<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contacto extends Model
{
    protected $table = 'contactos';
    protected $primaryKey = 'id';

    protected $fillable = [
		'name'
    ];

    public function telefonos(): HasMany
    {
        return $this->hasMany(Telefono::class);
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function direcciones(): HasMany
    {
        return $this->hasMany(Direccion::class);
    }
}
