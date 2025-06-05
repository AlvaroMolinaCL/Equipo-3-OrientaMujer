<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireQuestion extends Model
{
    protected $fillable = [
        'section_id', 'question', 'type', 'options', 'is_required', 'name', 'order', 'placeholder', 'help_text'
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(QuestionnaireSection::class, 'section_id');
    }
}