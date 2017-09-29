<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\Eloquent\User;

class UserRepositoryEloquent extends AbstractRepositoryEloquent implements UserRepository
{
    public function model()
    {
        return new User;
    }

    public function create($data = [])
    {
        $user = $this->model()->fill($data);
        $user->save();

        return $user;
    }

    public function find($id, $with = [], $select = ['*'])
    {
        return $this->model()->select($select)->with($with)->find($id);
    }

    public function findByPhone($phone)
    {
        return $this->model()->where('phone', $phone)->first();
    }

    public function getAllUser($permissionadmin, $permissiondoctor, $permissiondisable, $paginate)
    {
        return $this->model()->where('permission', $permissionadmin)->orwhere('permission', $permissiondoctor)->orwhere('permission', $permissiondisable)->paginate($paginate);
    }

}
