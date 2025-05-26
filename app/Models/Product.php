<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category', // si lo estás usando
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
