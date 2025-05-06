<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantPage extends Model
{
    protected $connection = 'central';
    
    protected $fillable = [
        'tenant_id',
        'page_key',
        'is_enabled',
        'settings',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
