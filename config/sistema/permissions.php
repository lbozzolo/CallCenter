<?php

return [

    'venta' => [
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
        ],
        [
            'name' => 'Ver reclamos venta',
            'slug' => 'ver.reclamos.venta',
            'description' => 'Ver los reclamos de una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        // Nuevos permisos

        [
            'name' => 'Ajustar venta',
            'slug' => 'ajustar.venta',
            'description' => 'Realizar un ajuste al importe de una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Quitar ajuste venta',
            'slug' => 'quitar.ajuste.venta',
            'description' => 'Quitar el ajuste realizado a una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Agregar método de pago',
            'slug' => 'agregar.metodo.pago.venta',
            'description' => 'Agregar un método de pago a una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Editar método pago venta',
            'slug' => 'editar.metodo.pago.venta',
            'description' => 'Editar un método de pago de una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Quitar método pago venta',
            'slug' => 'quitar.metodo.pago.venta',
            'description' => 'Quitar un método de pago de una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
    ],

    'cliente' => [
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
        ],
        [
            'name' => 'Agregar tarjeta cliente',
            'slug' => 'agregar.tarjeta.cliente',
            'description' => 'Agregar una tarjeta a un cliente',
            'model' => 'cliente',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Editar tarjeta cliente',
            'slug' => 'editar.tarjeta.cliente',
            'description' => 'Editar una tarjeta de un cliente',
            'model' => 'cliente',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Eliminar tarjeta cliente',
            'slug' => 'eliminar.tarjeta.cliente',
            'description' => 'Eliminar una tarjeta de un cliente',
            'model' => 'cliente',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
    ],

    'producto' => [
        [
            'name' => 'Cambiar estado de producto',
            'slug' => 'cambiar.estado.producto',
            'description' => 'Cambiar estado de un producto',
            'model' => 'producto',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
    ],

    'user' => [
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
    ],

    'reclamo' => [
        [
            'name' => 'Cambiar estado de reclamo',
            'slug' => 'cambiar.estado.reclamo',
            'description' => 'Cambiar estado de un reclamo',
            'model' => 'reclamo',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
    ],

    'asignacion' => [
        [
            'name' => 'Ver mis asignaciones',
            'slug' => 'ver.mis.asignaciones',
            'description' => 'Ver mis asignaciones',
            'model' => 'asignacion',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
    ],

];