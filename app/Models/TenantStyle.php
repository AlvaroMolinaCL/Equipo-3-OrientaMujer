<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantStyle extends Model
{
    protected $fillable = [
        'tenant_id',
        'page_key',
        'heading_font',
        'body_font',
        'link_font',
        'heading_color',
        'link_color',
        'text_color',
        'navbar_color',
        'background_color',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
