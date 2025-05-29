<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionnaireResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q7_detail', 'q8'
    ];
}
