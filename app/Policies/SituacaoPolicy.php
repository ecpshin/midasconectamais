<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Situacao;
use Illuminate\Auth\Access\HandlesAuthorization;

class SituacaoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_situacao');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Situacao $situacao): bool
    {
        return $user->can('view_situacao');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_situacao');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Situacao $situacao): bool
    {
        return $user->can('update_situacao');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Situacao $situacao): bool
    {
        return $user->can('delete_situacao');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_situacao');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Situacao $situacao): bool
    {
        return $user->can('force_delete_situacao');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_situacao');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Situacao $situacao): bool
    {
        return $user->can('restore_situacao');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_situacao');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Situacao $situacao): bool
    {
        return $user->can('replicate_situacao');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_situacao');
    }
}
