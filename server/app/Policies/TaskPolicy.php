<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given task can be updated by the user.
     */
    public function update(User $user, Task $task)
    {
        // Admin dapat update semua task, user hanya task miliknya
        return $user->role === 'admin' || $user->id === $task->user_id;
    }
    public function delete(User $user, Task $task)
    {
        // Admin dapat menghapus semua task, user hanya task miliknya
        return $user->role === 'admin' || $user->id === $task->user_id;
    }
}
