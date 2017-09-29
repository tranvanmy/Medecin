<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\AbstractRepository;

interface PostRepository extends AbstractRepository
{
    public function create($data = []);

    public function find($id, $select = ['*'], $with = []);

    public function getAllPost($paginate);

}
