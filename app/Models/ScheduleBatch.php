<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'days',
        'used_at',
    ];

    /**
     * Un batch tiene muchos horarios asociados.
     */
    public function slots()
    {
        return $this->hasMany(ScheduleBatchSlot::class, 'batch_id');
    }

    /**
     * Relación con el usuario que creó la carga.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}