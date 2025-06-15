<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    protected $fillable = ['tenant_id', 'user_id', 'title', 'description', 'status'];

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
