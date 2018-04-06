<?php namespace CallCenter\Http\Repositories;

abstract class BaseRepo
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public abstract function getModel();

    public function id($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(Array $datos)
    {
        return $this->model->create($datos);
    }

    public function edit($model, Array $datos)
    {
        $model->fill($datos);
        $model->save();

        return $model;
    }

    public function instanciar(Array $datos = [])
    {
        $model = $this->getModel();

        if (count($datos) > 0)
            $model->fill($datos);

        return $model;
    }

}