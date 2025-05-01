<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantPage extends Model
{
    protected $fillable = [
        'tenant_id',
        'page_key',
        'is_enabled',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
