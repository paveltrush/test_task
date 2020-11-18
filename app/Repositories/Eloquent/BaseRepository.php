<?php


namespace App\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = []): bool
    {
        return $this->model->save($options);
    }

    /**
     * @param $key
     * @param $value
     * @param string $operator
     * @return Collection
     */
    protected function getBy($key, $value, $operator = '='): Collection
    {
        return $this->model->all()->where($key, $operator, $value);
    }

    /**
     * @param $key
     * @param string $operator
     * @param $value
     * @return Collection
     */
    protected function where($key, string $operator, $value): Collection
    {
        return $this->model->where($key, $operator, $value);
    }
}
