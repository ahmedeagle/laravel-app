<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function getAllUsers(array $filters = [])
    {
        return User::when(isset($filters['first_name']), function (Builder $query) use ($filters) {
                return $query->where('first_name', 'like', "%{$filters['first_name']}%");
            })
            ->when(isset($filters['gender']), function (Builder $query) use ($filters) {
                return $query->where('gender', $filters['gender']);
            })
            ->when(isset($filters['date_of_birth']), function (Builder $query) use ($filters) {
                return $query->whereDate('date_of_birth', $filters['date_of_birth']);
            })
            ->paginate(10);
    }

    public function findUserById($id)
    {
        return User::with('projects', 'timesheets')->findOrFail($id);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }
}
