<?php

return [

    // Describir los slugs de los permisos que NO DEBE TENER cada rol

    'admin' => [],

    'operador-in' => [

        // Producto
        'crear.producto',
        'editar.producto',
        'eliminar.producto',
        'cambiar.estado.producto',

        // Datos Tarjeta
        'visualizar.numero.tarjeta',

        // Venta
        'cambiar.estado.venta',
        'editar.numero.guia'

    ],

    'operador-out' => [

        // Producto
        'crear.producto',
        'editar.producto',
        'eliminar.producto',
        'cambiar.estado.producto',

        // Datos Tarjeta
        'visualizar.numero.tarjeta',

        // Venta
        'cambiar.estado.venta',
        'editar.numero.guia'

    ],

    'auditor' => [

        // Producto
        'crear.producto',
        'editar.producto',
        'eliminar.producto',
        'cambiar.estado.producto',

        // Asignacion
        'crear.asignacion',
        'ver.asignacion',
        'listado.asignacion',
        'editar.asignacion',
        'eliminar.asignacion',
        'ver.mis.asignaciones',

        // Formas de pago
        'crear.forma.de.pago',
        'editar.forma.de.pago',
        'eliminar.forma.de.pago',

        // Promoción
        'crear.promocion',
        'editar.promocion',
        'eliminar.promocion',

        // Datos Tarjeta
        'crear.datos.de.tarjeta',
        'editar.datos.de.tarjeta',
        'eliminar.datos.de.tarjeta',
        'visualizar.numero.tarjeta',

        // Venta
        'crear.venta',
        'eliminar.venta',
        'retomar.venta',
        'quitar.producto.venta',
        'ajustar.venta',
        'quitar.ajuste.venta',
        'agregar.metodo.pago.venta',
        'editar.metodo.pago.venta',
        'quitar.metodo.pago.venta',

    ],

    'supervisor' => [],

    'logistica' => [],

    'facturacion' => [],

    'atencion-al-cliente' => [

        // Marca
        'crear.marca',
        'editar.marca',
        'eliminar.marca',

        // Soporte
        'eliminar.ticket',
        'change.state.ticket',

        // Método de pago
        'crear.metodo.de.pago',
        'editar.metodo.de.pago',
        'eliminar.metodo.de.pago',

        // Banco
        'crear.banco',
        'editar.banco',
        'eliminar.banco',

        // Etapa
        'crear.etapa',

        // Producto
        'crear.producto',

        // Asignación
        'crear.asignacion',
        'editar.asignacion',
        'eliminar.asignacion',

        // Forma de pago
        'crear.forma.de.pago',
        'editar.forma.de.pago',
        'eliminar.forma.de.pago',

        // Promoción
        'crear.promocion',
        'editar.promocion',
        'eliminar.promocion',

        // Categoría
        'crear.categoria',
        'editar.categoria',
        'eliminar.categoria',

        // Imagen
        'crear.imagen',
        'editar.imagen',
        'eliminar.imagen',

        // Reclamo
        'editar.reclamo',
        'eliminar.reclamo',

        // Cliente
        'crear.cliente',
        'editar.cliente',
        'eliminar.cliente',
        'eliminar.tarjeta.cliente',

        // Institución
        'crear.institucion',

        // Updeteable
        'crear.updateable',

        // Datos de tarjeta
        'crear.datos.de.tarjeta',
        'editar.datos.de.tarjeta',
        'eliminar.datos.de.tarjeta',
        'visualizar.numero.tarjeta',

        // Noticia
        'crear.noticia',
        'editar.noticia',
        'eliminar.noticia',

        // Usuario
        'crear.usuario',
        'editar.usuario',
        'eliminar.usuario',
        'listado.usuarios.nuevos',
        'cambiar.estado.usuario',
        'editar.permisos.usuario',

        // Venta
        'crear.venta',
        'eliminar.venta',


    ]

];