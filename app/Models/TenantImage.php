<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantImage extends Model
{
    protected $fillable = [
        'tenant_id',
        'page_key',
        'image_key',
        'image_path',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}