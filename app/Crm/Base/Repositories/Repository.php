<?php

namespace App\Crm\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected Model $model;

    public function all()
    {
        return $this->model->all();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): ?Model
    {
        foreach ($data as $field => $val) {
            $this->model->{$field} = $val;
        }
        $this->model->save();
       return $this->model;
    }

    public function update(array $data): ?Model
    {
        $model = $this->model->find($data['id'] ?? 0);
        if(!$model)
            return null;

        foreach ($data as $field => $val) {
            $this->model->{$field} = $val;
        }
        $this->model->save();
        return $this->model;
    }

    public function delete($id): bool
    {
        $this->model = $this->model->find($id);
        return $this->model->delete();
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

}
