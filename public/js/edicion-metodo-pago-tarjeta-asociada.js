$(document).ready(function() {

    // Edición Método Pago Venta

    $('.botonEditarMetodoPagoVenta').click(function (ev){
        ev.preventDefault();
        cancelarEdicionMetodoPago();
        var metodoPagoVentaId = $(this).attr('data-id');
        $('#showMetodoPagoVenta' + metodoPagoVentaId).hide();
        $('#editarMetodoPagoVenta' + metodoPagoVentaId).show();
        $('#input' + metodoPagoVentaId).focus();
    });

    $('.botonCancelarEdicionMetodoPago').click(function (ev) {
        ev.preventDefault();
        cancelarEdicionMetodoPago();
    });

    function cancelarEdicionMetodoPago () {
        $('.showMetodoPagoVenta').show();
        $('.editarMetodoPagoVenta').hide();
    }

    // Edición Tarjeta Asociada

    $('.botonEditarTarjetaAsociada').click(function (ev){
        ev.preventDefault();
        var tarjetaId = $(this).attr('data-id');
        cancelarEdicionTarjetaAsociada();
        $('#showTarjetaAsociada' + tarjetaId).hide();
        $('#editarTarjetaAsociada' + tarjetaId).show();
    });

    $('.botonCancelarEdicionTarjetaAsociada').click(function (ev) {
        ev.preventDefault();
        cancelarEdicionTarjetaAsociada();
    });

    function cancelarEdicionTarjetaAsociada () {
        $('.showTarjetaAsociada').show();
        $('.editarTarjetaAsociada').hide();
    }

});