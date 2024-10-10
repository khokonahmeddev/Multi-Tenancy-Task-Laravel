<?php

namespace App\Models\Tenant;

use App\Models\Concerns\BelongToTenant;
use Illuminate\Database\Eloquent\Model;

class TenantBaseModel extends Model
{
    use BelongToTenant;
}
