<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['order', 'name', 'ordinal_symbol'];

    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}
