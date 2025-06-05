<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireSection extends Model
{
    protected $fillable = ['title', 'icon', 'order'];

    public function questions()
    {
        return $this->hasMany(QuestionnaireQuestion::class, 'section_id')->orderBy('order');
    }
}
