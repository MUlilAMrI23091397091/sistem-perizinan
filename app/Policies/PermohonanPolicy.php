<?php

namespace App\Policies;

use App\Models\Permohonan;
use App\Models\User;

class PermohonanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // semua user login bisa lihat daftar permohonan
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permohonan $permohonan): bool
    {
        // admin boleh lihat semua, atau user hanya bisa lihat miliknya
        return $user->role === 'admin' || $user->id === $permohonan->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // semua user login boleh bikin permohonan
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permohonan $permohonan): bool
    {
        // admin boleh update semua, atau user hanya boleh update miliknya
        return $user->role === 'admin' || $user->id === $permohonan->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permohonan $permohonan): bool
    {
        // admin, pd_teknis, dan dpmptsp boleh hapus semua, atau user hanya boleh hapus miliknya
        return in_array($user->role, ['admin', 'pd_teknis', 'dpmptsp']) || $user->id === $permohonan->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permohonan $permohonan): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permohonan $permohonan): bool
    {
        return $user->role === 'admin';
    }
}
