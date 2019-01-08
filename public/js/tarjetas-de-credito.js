$('.select2').select2();
$('.datepicker').datepicker({
    format: "mm/yyyy",
    viewMode: "months",
    minViewMode: "months"
});

if($('#metodoPago option:selected').html() === 'Tarjeta de crédito'){
    $('#conTarjeta').show();
    $('#conCredito').show();
    $('.select2').select2();
}

if($('#metodoPago option:selected').html() === 'Tarjeta de débito'){
    $('#conTarjeta').show();
    $('#conDebito').show();
    $('.select2').select2();
}

$('#metodoPago').change(function () {

    if($('#metodoPago option:selected').html() === 'Tarjeta de crédito' || $('#metodoPago option:selected').html() === 'Tarjeta de débito'){

        $('#conTarjeta').show();
        $('.select2').select2();

        if($('#metodoPago option:selected').html() === 'Tarjeta de crédito'){
            $('#marcaDebito').val('');
            $('#conDebito').hide();
            $('#conCredito').show();
        }
        if($('#metodoPago option:selected').html() === 'Tarjeta de débito'){
            $('#marcaCredito').val('');
            $('#conCredito').hide();
            $('#conDebito').show();
        }

    }else{

        $('#conTarjeta').hide();
        $('.inputConTarjeta').val('');
        $('#marcaCredito').val('');
        $('#conCredito').hide();
        $('#marcaDebito').val('');
        $('#conDebito').hide();

    }

});