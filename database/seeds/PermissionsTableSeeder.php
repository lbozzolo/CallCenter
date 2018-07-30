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
        $names = ['marca', 'banco', 'categoría', 'cliente', 'etapa', 'forma de pago', 'imagen', 'institución', 'llamada', 'método de pago', 'producto', 'promoción', 'reclamo', 'usuario', 'venta',];
        $acciones = array_combine($models, $names);

        foreach($acciones as $model => $name){
            DB::table('permissions')->insert([
                $this->crearModel($model, $name),
                $this->verModel($model, $name),
                $this->listarModel($model, $name),
                $this->editarModel($model, $name),
                $this->eliminarModel($model, $name)
            ]);
        }

        /*================
         * PERMISOS EXTRA
         =================*/

        //Permisos de Venta

        DB::table('permissions')->insert([
            [
                'name' => 'Cancelar venta',
                'slug' => 'cancelar.venta',
                'description' => 'Cancelar una venta',
                'model' => 'venta',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Aceptar venta',
                'slug' => 'aceptar.venta',
                'description' => 'Aceptar una venta',
                'model' => 'venta',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Retomar venta',
                'slug' => 'retomar.venta',
                'description' => 'Retomar una venta',
                'model' => 'venta',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Cerrar venta',
                'slug' => 'cerrar.venta',
                'description' => 'Cerrar una venta',
                'model' => 'venta',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Quitar producto de venta',
                'slug' => 'quitar.producto.venta',
                'description' => 'Quitar un producto de una venta',
                'model' => 'venta',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ]
        ]);

        //Permisos de Producto

        DB::table('permissions')->insert([
            [
                'name' => 'Cambiar estado de producto',
                'slug' => 'cambiar.estado.producto',
                'description' => 'Cambiar estado de un producto',
                'model' => 'producto',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
        ]);

        //Permisos de Cliente

        DB::table('permissions')->insert([
            [
                'name' => 'Ver compras cliente',
                'slug' => 'ver.compras.cliente',
                'description' => 'Ver compras de un cliente',
                'model' => 'cliente',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Ver llamadas cliente',
                'slug' => 'ver.llamadas.cliente',
                'description' => 'Ver llamadas de un cliente',
                'model' => 'cliente',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Ver reclamos cliente',
                'slug' => 'ver.reclamos.cliente',
                'description' => 'Ver reclamos de un cliente',
                'model' => 'cliente',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Ver intereses cliente',
                'slug' => 'ver.intereses.cliente',
                'description' => 'Ver intereses de un cliente',
                'model' => 'cliente',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ]
        ]);

        //Permisos de Usuario

        DB::table('permissions')->insert([
            [
                'name' => 'Ver listado usuarios nuevos',
                'slug' => 'listado.usuarios.nuevos',
                'description' => 'Ver listado de usuarios nuevos',
                'model' => 'user',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Cambiar estado de usuario',
                'slug' => 'cambiar.estado.usuario',
                'description' => 'Cambiar estado de usuario',
                'model' => 'user',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Editar permisos de usuario',
                'slug' => 'editar.permisos.usuario',
                'description' => 'Editar permisos de usuario',
                'model' => 'user',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ]
        ]);

        //Permisos de Reclamo

        DB::table('permissions')->insert([
            [
                'name' => 'Cambiar estado de reclamo',
                'slug' => 'cambiar.estado.reclamo',
                'description' => 'Cambiar estado de un reclamo',
                'model' => 'reclamo',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
        ]);

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
