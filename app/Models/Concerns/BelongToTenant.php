<?php

namespace App\Models\Concerns;

use App\Models\Tenant\Tenant;
use App\Scopes\TenantScope;

trait BelongToTenant
{
    protected static function bootBelongToTenant(): void
    {
        if (!app()->runningInConsole()) {
            static::addGlobalScope(new TenantScope());

            $tenant = Tenant::query()->where('id', auth()->user()?->tenant_id)->first();
            if ($tenant) {
                static::creating(fn($model) => $model->tenant_id ?: $model->tenant_id = $tenant->id);
                static::saving(fn($model) => $model->tenant_id ?: $model->tenant_id = $tenant->id);
            }

        }
    }

    public function tenant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }


}
