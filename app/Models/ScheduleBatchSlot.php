<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleBatchSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'day_index',
        'start_time',
        'end_time',
        'max_bookings',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    // Relaciones
    public function batch()
    {
        return $this->belongsTo(ScheduleBatch::class, 'batch_id');
    }
}