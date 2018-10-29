$(document).ready(function() {

    // Agregar método de pago

    $('#botonNuevoProducto').click(function () {
        $('#botonNuevoProducto').hide();
        $('#botonNuevoProductoCancelar').show();
        $('#listadoProductos').show();
    });

    $('#botonNuevoProductoCancelar').click(function () {
        $('#botonNuevoProducto').show();
        $('#botonNuevoProductoCancelar').hide();
        $('#listadoProductos').hide();
    });

    $('#botonNuevoMetodo').click(function () {
        $('#botonNuevoMetodo').hide();
        $('#nuevoMetodo').show();
    });

    $('#selectMetodo').change(function () {
        var selected = $('#selectMetodo option:selected').text();
        if(selected === 'Tarjeta de crédito'){
            $('#selectTarjetaDebito').hide();
            $('#selectCuotas').show();
            $('#selectTarjetaCredito').show();
        }
        if(selected === 'Tarjeta de débito'){
            $('#selectTarjetaCredito').hide();
            $('#selectTarjetaDebito').show();
        }
        if(selected === 'Efectivo'){
            $('#selectCredito').val('');
            $('#selectDebito').val('');
            $('#cuotas').val('');
            $('#selectTarjetaCredito').hide();
            $('#selectTarjetaDebito').hide();
            $('#selectCuotas').hide();
        }
    });

    $('#botonNuevaTarjeta').click(function () {
        $('#botonNuevaTarjeta').hide();
        $('#nuevaTarjeta').show();
    });

    $('#cancelarAgregarMetodoPago').click(function () {
        $('#selectMetodo').val('');
        $('#selectCredito').val('');
        $('#selectDebito').val('');
        $('#inputImporte').val('');
        $('#cuotas').val('');
        $('#selectTarjetaCredito').hide();
        $('#selectTarjetaDebito').hide();
        $('#selectCuotas').hide();
        $('#botonNuevoMetodo').show()
        $('#nuevoMetodo').hide();
    });

    $('#cancelarAsociarTarjeta').click(function () {
        $('#marcaCredito').val('');
        $('#banco').val('');
        $('#numeroTarjeta').val('');
        $('#codigoSeguridad').val('');
        $('#titular').val('');
        $('#fechaExpiracion').val('');
        $('#botonNuevaTarjeta').show()
        $('#nuevaTarjeta').hide();
    });

});