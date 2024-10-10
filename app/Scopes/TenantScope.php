<?php

namespace App\Scopes;

use App\Models\Tenant\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (app()->runningInConsole() || app()->runningUnitTests()) {
            return true;
        }

        $tenant = Tenant::query()->where('id', auth()->user()?->tenant_id)->first();
        $builder->when($tenant, fn($builder) => $builder->where('tenant_id', $tenant->id));
    }
}
