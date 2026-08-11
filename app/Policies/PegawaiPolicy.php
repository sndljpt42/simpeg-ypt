<?php

namespace App\Policies;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PegawaiPolicy
{
    /**
     * Menentukan apakah user boleh melihat daftar seluruh pegawai.
     */
    public function viewAny(User $user): bool
    {
        // Admin dan operator sama-sama boleh melihat data pegawai.
        return in_array($user->role, ['admin', 'operator']);
    }

    /**
     * Menentukan apakah user boleh melihat detail seorang pegawai.
     */
    public function view(User $user, Pegawai $pegawai): bool
    {
        //admin dan operator sama-sama boleh melihat detail pegawai
        return in_array($user->role, ['admin', 'operator']);
    }

    /**
     * Menentukan apakah user boleh menambahkan pegawai baru.
     */
    public function create(User $user): bool
    {
        // Admin dan operator diperbolehkan menambahkan data.
        return in_array($user->role, ['admin', 'operator']);
    }

    /**
     * Menentukan apakah user boleh mengubah data pegawai.
     */
    public function update(User $user, Pegawai $pegawai): bool
    {
        // Admin dan operator diperbolehkan mengubah data.
        return in_array($user->role, ['admin', 'operator']);
    }

    /**
     * Menentukan apakah user boleh melakukan soft delete.
     */
    public function delete(User $user, Pegawai $pegawai): bool
    {
        // Admin dan operator diperbolehkan melakukan soft delete.
        return in_array($user->role, ['admin', 'operator']);
    }

    /**
     * Menentukan apakah user boleh memulihkan data dari Trash.
     */
    public function restore(User $user, Pegawai $pegawai): bool
    {
        // Admin dan operator diperbolehkan melakukan restore.
        return in_array($user->role, ['admin', 'operator']);
    }

    /**
     * Menentukan apakah user boleh menghapus data secara permanen.
     */
    public function forceDelete(User $user, Pegawai $pegawai): bool
    {
        
        // Force delete adalah operasi sensitif.
        // Hanya user dengan role admin yang diperbolehkan.
        return $user->role === 'admin';
    }
}
