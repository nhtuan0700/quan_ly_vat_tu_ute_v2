<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Config;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;
    protected $limit;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
        $this->limit = Config::get('constants.limit_page');
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getDatabaseName()
    {
        $databaseName = Config::get('database.connections');

        return $databaseName['mysql']['database'];
    }

    public function all($columns = '*')
    {
        return $this->model->all($columns);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->model->findOrFail($id);
        return $result->update($attributes);
    }

    public function delete($id)
    {
        $result = $this->findOrFail($id);
        return $result->delete();
    }

    public function paginate($direction = 'desc', $limit = NULL)
    {
        $limit = $limit ?? $this->limit;
        return $this->model->orderBy('id', $direction)->paginate($limit);
    }

    public function search($columns, $strict, $limit = NULL, $model = NULL)
    {
        $limit = $limit ?? $this->limit;
        $model = $model ?? $this->model;
        foreach ($columns as $column => $value) {
            if (is_null($value)) {
                continue;
            }
            if (in_array($column, $strict)) {
                $model = $model->where($column, $value);
            } else {
                $model = $model->where($column, 'like', '%' . $value . '%');
            }
        }
        return $model->orderBy('id', 'desc')->paginate($limit)->appends(request()->all());
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function where($column, $value)
    {
        return $this->model->where($column, $value);
    }

    public function query()
    {
        return $this->model->query();
    }
}
