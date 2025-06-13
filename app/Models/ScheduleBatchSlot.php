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
    ];

    /**
     * Cada slot pertenece a un batch.
     */
    public function batch()
    {
        return $this->belongsTo(ScheduleBatch::class, 'batch_id');
    }
}