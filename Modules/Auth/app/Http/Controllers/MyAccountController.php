<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Auth\Http\Requests\UpdatePasswordRequest;
use Modules\Auth\Http\Requests\UpdateProfileRequest;
use Modules\Auth\Http\Resources\UserResource;
use Modules\Auth\Http\Resources\UserSessionResource;

class MyAccountController extends Controller
{
    public function updateProfile(UpdateProfileRequest $request): UserResource
    {
        $user = $request->user();
        $user->update($request->validated());

        return new UserResource($user);
    }

    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $user = $request->user();

        if (! Hash::check($request->string('current_password'), $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password saat ini salah.',
            ]);
        }

        // forceFill: password_changed_at bukan mass-assignable ($fillable
        // di model User tidak mencakupnya), jadi update() biasa diam-diam
        // mengabaikannya.
        $user->forceFill([
            'password' => Hash::make($request->string('password')),
            'password_changed_at' => now(),
        ])->save();

        // Ganti password = invalidasi sesi lain, tapi device yang sedang
        // dipakai untuk ganti password sendiri tidak boleh ikut logout.
        $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Password berhasil diubah.']);
    }

    public function sessions(Request $request): AnonymousResourceCollection
    {
        $tokens = $request->user()->tokens()
            ->orderByRaw('COALESCE(last_used_at, created_at) DESC')
            ->get();

        return UserSessionResource::collection($tokens);
    }

    public function revokeAllSessions(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Semua sesi berhasil di-logout.']);
    }
}
