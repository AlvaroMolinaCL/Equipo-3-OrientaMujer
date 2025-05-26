<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantText extends Model
{
    protected $connection = 'central'; 
    protected $table = 'tenant_texts';

    protected $fillable = ['tenant_id', 'key', 'value'];
}
