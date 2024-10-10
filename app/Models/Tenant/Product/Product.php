<?php

namespace App\Models\Tenant\Product;

use App\Models\Tenant\TenantBaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends TenantBaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'tenant_id',
    ];
}
