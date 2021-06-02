<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use TenantTrait;

    protected $fillable = ['identify', 'description'];
}
