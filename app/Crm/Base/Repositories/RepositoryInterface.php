<?php

namespace App\Crm\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all();
    public function find($id): ?Model;
    public function create(array $data): ?Model;
    public function update(array $data): ?Model;
    public function delete($id): bool;
}
