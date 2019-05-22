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
        [
            'name' => 'Ver timeline venta',
            'slug' => 'ver.timeline.venta',
            'description' => 'Ver el timeline de una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Listar ventas para auditoría',
            'slug' => 'listado.auditoria.venta',
            'description' => 'Listar ventas listas para auditar',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Listar ventas para facturación',
            'slug' => 'listado.facturacion.venta',
            'description' => 'Listar ventas listas para facturar',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Listar ventas para logística',
            'slug' => 'listado.logistica.venta',
            'description' => 'Listar ventas listas para hacer seguimiento de logística',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Listar ventas para postventa',
            'slug' => 'listado.postventa.venta',
            'description' => 'Listar ventas para hacer postventa',
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
        [
            'name' => 'Cambiar estado de venta',
            'slug' => 'cambiar.estado.venta',
            'description' => 'Cambiar el estado de una venta',
            'model' => 'venta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Editar número de guía',
            'slug' => 'editar.numero.guia',
            'description' => 'Editar el número de guía',
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
        ],
        [
            'name' => 'Ver Perfil',
            'slug' => 'ver.perfil',
            'description' => 'Ver el perfil del usuario',
            'model' => 'user',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Editar Perfil',
            'slug' => 'editar.perfil',
            'description' => 'Editar el perfil del usuario',
            'model' => 'user',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Cambiar contraseña del usuario',
            'slug' => 'cambiar.password.perfil',
            'description' => 'Cambiar la contraseña del usuario',
            'model' => 'user',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
        [
            'name' => 'Subir imagen del usuario',
            'slug' => 'subir.imagen.perfil',
            'description' => 'Subir imagen del usuario',
            'model' => 'user',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
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
        [
            'name' => 'Derivar reclamo',
            'slug' => 'derivar.reclamo',
            'description' => 'Derivar reclamo',
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

    'ticket' => [
        [
            'name' => 'Cambiar estado de ticket',
            'slug' => 'change.state.ticket',
            'description' => 'Cambia el estado de un ticket',
            'model' => 'ticket',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
    ],

    'datoTarjeta' => [
        [
            'name' => 'Visualizar número de tarjeta',
            'slug' => 'visualizar.numero.tarjeta',
            'description' => 'Visualizar número de tarjeta',
            'model' => 'datoTarjeta',
            'created_at' => date_create(),
            'updated_at' => date_create()
        ],
    ],

];