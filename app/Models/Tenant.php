<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'logo_path',
        'favicon_path',
        'default_locale',
        'navbar_color',
        'background_color',
        'heading_font',
        'body_font',
        'link_font',
    ];

    public function pages()
    {
        return $this->hasMany(TenantPage::class);
    }

    public function styles()
    {
        return $this->hasMany(TenantStyle::class);
    }

    public function images()
    {
        return $this->hasMany(TenantImage::class);
    }

    public function settings()
    {
        return $this->hasMany(TenantSetting::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
