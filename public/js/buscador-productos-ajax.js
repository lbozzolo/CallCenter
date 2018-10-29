$(document).ready(function() {


    $('.select2').select2();

    $('#div-table-resultados').hide();
    $('#sinresultados').hide();

    $("#producto_valor").keypress(function(ev) {
        if(ev.which === 13) {
            $('#cargando').show();
            ev.preventDefault();
            var token = $("input[name*='_token']").val();
            var valor = $("#producto_valor").val();
            $('#tbl-resultados tbody').empty();

            $.ajax({
                method: 'GET',
                url: 'productos/buscar',
                headers: {"X-CSRF-TOKEN": token},
                dataType: 'json',
                data: {
                    valor: valor
                }

            }).done(ResultadoSearch);
        }
    });


    $("#search").click(function( ev ){


        $('#cargando').show();
        ev.preventDefault();
        var token = $("input[name*='_token']").val();
        var valor = $("#producto_valor").val();
        $('#tbl-resultados tbody').empty();

        $.ajax({
            method: 'GET',
            url: 'productos/buscar',
            headers: {"X-CSRF-TOKEN": token},
            dataType: 'json',
            data: {
                valor: valor
            }

        }).done(ResultadoSearch);

    });

    function ResultadoSearch(data)
    {

        $('#cargando').hide();
        var html;
        var table = $('#tbl-resultados tbody');

        if(data.length > 0) {
            $.each(data, function (i, d) {

                var id = d.id;
                html = '<tr>';
                html += '<td>' + d.id + '</td>';
                html += '<td><em class="icon-layers"></em> ' + d.nombre + '</td>';
                if(d.marca){
                    html += '<td><em class="icon-layers"></em> ' + d.marca.nombre + '</td>';
                }else{
                    html += '<td><em class="icon-layers"></em>--</td>';
                }
                html += '<td>$' + d.precio + '</td>';
                html += '<td>';
                html += '<input name="venta_id" type="hidden" value="{{ $venta->id }}">';
                html += '<input name="producto_id" type="hidden" value="' + d.id + '">';
                html += '<button type="submit" id="agregar_producto" class="btn btn-primary btn-xs">agregar</button>';
                html += '</td>';
                html += '</tr>';
                table.append(html);
            });
            $('#sinresultados').hide();
            $('#div-table-resultados').show();

        }else{

            $('#div-table-resultados').hide();
            $('#sinresultados').show();

        }

    }



});