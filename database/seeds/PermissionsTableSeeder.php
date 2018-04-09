<?php

use Illuminate\Database\Seeder;
use CallCenter\Entities\Entity;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = Entity::getModels();
        $names = ['banco', 'categoría', 'cliente', 'etapa', 'forma de pago', 'imagen', 'institución', 'llamada', 'método de pago', 'producto', 'promoción', 'reclamo', 'usuario', 'venta',];
        $acciones = array_combine($models, $names);


        foreach($acciones as $model => $name){
            DB::table('permissions')->insert($this->crearModel($model, $name));
        }

        foreach($acciones as $model => $name){
            DB::table('permissions')->insert($this->verModel($model, $name));
        }

        foreach($acciones as $model => $name){
            DB::table('permissions')->insert($this->listarModel($model, $name));
        }

        foreach($acciones as $model => $name){
            DB::table('permissions')->insert($this->editarModel($model, $name));
        }

        foreach($acciones as $model => $name){
            DB::table('permissions')->insert($this->eliminarModel($model, $name));
        }

    }

    public function crearModel($model, $name)
    {
        return [
            'name' => 'Crear '.$name,
            'slug' => 'crear.'.$name,
            'description' => 'Crear '.$name,
            'model' => $model,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ];
    }

    public function verModel($model, $name)
    {
        return [
            'name' => 'Ver '.$name,
            'slug' => 'ver.'.$name,
            'description' => 'Ver '.$name,
            'model' => $model,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ];
    }

    public function listarModel($model, $name)
    {
        return [
            'name' => 'Ver listado '.$name,
            'slug' => 'listado.'.$name,
            'description' => 'Ver listado '.$name,
            'model' => $model,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ];
    }

    public function editarModel($model, $name)
    {
        return [
            'name' => 'Editar '.$name,
            'slug' => 'editar.'.$name,
            'description' => 'Editar '.$name ,
            'model' => $model,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ];
    }

    public function eliminarModel($model, $name)
    {
        return [
            'name' => 'Eliminar '.$name,
            'slug' => 'eliminar.'.$name,
            'description' => 'Eliminar '.$name ,
            'model' => $model,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ];
    }

}
