<?php

use Illuminate\Database\Seeder;
use SmartLine\Entities\Entity;
use Illuminate\Support\Facades\DB;

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
        $names = ['marca', 'banco', 'asignacion', 'categoría', 'cliente', 'datos de tarjeta', 'etapa', 'forma de pago', 'imagen', 'institución', 'llamada', 'método de pago', 'noticia', 'producto', 'promoción', 'reclamo', 'usuario', 'venta',];
        $acciones = array_combine($models, $names);

        foreach($acciones as $model => $name){
            DB::table('permissions')->insert([
                $this->crearModel($model, $name),
                $this->verModel($model, $name),
                $this->listarModel($model, $name),
                $this->editarModel($model, $name),
                $this->eliminarModel($model, $name)
            ]);

            if(array_key_exists($model, config('sistema.permissions')))
                DB::table('permissions')->insert(config('sistema.permissions.'.$model));

        }

    }

    public function crearModel($model, $name)
    {
        return [
            'name' => 'Crear '.$name,
            'slug' => str_slug('crear.'.$name, '.'),
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
            'slug' => str_slug('ver.'.$name, '.'),
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
            'slug' => str_slug('listado.'.$name, '.'),
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
            'slug' => str_slug('editar.'.$name, '.'),
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
            'slug' => str_slug('eliminar.'.$name, '.'),
            'description' => 'Eliminar '.$name ,
            'model' => $model,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ];
    }

}
