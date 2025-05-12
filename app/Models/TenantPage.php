<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantPage extends Model
{
    protected $connection = 'central';

    protected $fillable = [
        'tenant_id',
        'page_key',
        'title',
        'is_enabled',
        'is_visible',
        'settings',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function pages()
    {
        return $this->hasMany(TenantPage::class);
    }
}
