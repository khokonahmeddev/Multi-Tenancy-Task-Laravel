<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Tenant\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $tenant = Tenant::query()->create([
                'name' => $request->company_name,
                'slug' => Str::slug($request->company_name . '-' . Str::random(5)),
            ]);

            $tenant->users()->create($request->only('name', 'email', 'password'));

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
            ]);
            
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => app()->environment('local') ? $exception->getMessage() : 'Registration has been failed',
            ], 400);
        }
    }
}
