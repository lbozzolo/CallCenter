$(document).ready(function() {

    $('.btn-consulta-cotizacion').click(function () {

        $('#tbl-resultados').hide();
        $('#tbl-resultados-comprador').hide();
        $('#tbl-resultados tbody').empty();
        $('#tbl-resultados-comprador tbody').empty();
        $('#errores ul').empty();
        $('#errores').hide();
        $(".overlay").show();
    });


    $("#formCotizacion").on('submit', function( ev ){

        ev.preventDefault();
        var provincia = $("#select-provincia").val();
        var codigoPostal = $("input[name=codigo_postal]").val();
        var peso = $("input[name=peso]").val();
        var paquetes = $("input[name=paquetes]").val();
        var datosEnvio = $("input[name=direccion_envio]").val();
        provincia = provincia.substring(3);

        $.ajax({
            method: 'GET',
            url: '../ws/cotizaciones/cotizacion',
            headers: {"Content-type" : "application/x-www-form-urlencoded"},
            dataType: 'json',
            data: {
                provincia : provincia,
                codigoPostal : codigoPostal,
                peso : peso,
                paquetes : paquetes,
                datosEnvio : datosEnvio
            },
            success: function(data){
                ResultadoSearch(data);
            },
            error: function(data){
                var errors = data.responseJSON;
                var errores = $('#errores');
                var erroresLista = $('#errores ul');
                var html = '';

                erroresLista.empty();
                $.each(errors, function (i, d) {
                    html += '<li class="alert alert-danger">' + d + '</li>'
                    if(i === 'provincia'){
                        $('#select-provincia').css('border', '1px solid red');
                    }
                });
                $(".overlay").hide();
                erroresLista.append(html);
                errores.show();

            }

        });

    });

    function ResultadoSearch(data)
    {
        var html;

        var table = $('#tbl-resultados tbody');
        table.empty();

        if(data.results.length === 0){

            html = '<tr>';
            html += '<td colspan="8">' + 'No hay resultados para su consulta' + '</td>';
            html += '<tr>';
            table.append(html);

        }

        if(data.results.length > 0)
        {
            $.each(data.results, function(i, d) {

                var servicio = '';
                switch(d.servicio) {
                    case 'N':
                        servicio = '<label class="label label-default">Estándar</label>';
                        break;
                    case 'P':
                        servicio = '<label class="label label-info">Prioritario</label>';
                        break;
                    case 'X':
                        servicio = '<label class="label label-success">Exprés</label>';
                        break;
                    case 'R':
                        servicio = '<label class="label label-warning">Devoluciones</label>';
                        break;
                }


                html =  '<tr>';
                    html += '<td>' + d.correo.nombre + '</td>';
                    html += '<td>' + (d.despacho === 'D'? 'Domicilio' : '<strong>Sucursal</strong>') + '</td>';
                    html += '<td>' + (d.modalidad === 'D'? 'Domicilio' : '<strong>Sucursal</strong>') + '</td>';
                    html += '<td>' + d.horas_entrega + ' hs</td>';
                    html += '<td>' + d.peso_desde + ' kg / ' + d.peso_hasta + 'kg</td>';
                    html += '<td>' + servicio + '</td>';
                    html += '<td><strong style="color: deeppink">$ ' + d.valor + '</strong></td>';
                html += '</tr>';

                table.append(html);

            });
        }

        $(".overlay").hide();
        $('#tbl-resultados').show();

    }


    $("#formCotizacionComprador").on('submit', function( ev ){

        ev.preventDefault();
        var provincia = $("#select-provincia-comprador").val();
        var codigoPostal = $("#codigo-postal-comprador").val();
        var peso = $("#peso-comprador").val();
        var paquetes = $("#paquetes-comprador").val();
        var correo = $('#correo-comprador').val();
        var datosEnvio = $("#direccion-envio-comprador").val();
        provincia = provincia.substring(3);

        $.ajax({
            method: 'GET',
            url: '../ws/cotizaciones/comprador',
            headers: {"Content-type" : "application/x-www-form-urlencoded"},
            dataType: 'json',
            data: {
                provincia : provincia,
                codigoPostal : codigoPostal,
                peso : peso,
                paquetes : paquetes,
                correo : correo,
                datosEnvio : datosEnvio
            },
            success: function(data){
                ResultadoComprador(data);
            },
            error: function(data){
                var errors = data.responseJSON;
                var errores = $('#errores');
                var erroresLista = $('#errores ul');
                var html = '';

                erroresLista.empty();
                $.each(errors, function (i, d) {
                    html += '<li class="alert alert-danger">' + d + '</li>'
                });
                $(".overlay").hide();
                erroresLista.append(html);
                errores.show();

            }

        });

    });


    function ResultadoComprador(data)
    {
        var html;

        var table = $('#tbl-resultados-comprador tbody');
        table.empty();

        if(data.results.length === 0){

            html = '<tr>';
            html += '<td colspan="8">' + 'No hay resultados para su consulta' + '</td>';
            html += '<tr>';
            table.append(html);

        }

        if(data.results.length > 0)
        {
            $.each(data.results, function(i, d) {

                var servicio = '';
                switch(d.servicio) {
                    case 'N':
                        servicio = '<label class="label label-default">Estándar</label>';
                        break;
                    case 'P':
                        servicio = '<label class="label label-info">Prioritario</label>';
                        break;
                    case 'X':
                        servicio = '<label class="label label-success">Exprés</label>';
                        break;
                    case 'R':
                        servicio = '<label class="label label-warning">Devoluciones</label>';
                        break;
                }

                var correo = d.sucursal.correo.nombre;
                $('#tbl-resultados-comprador-caption').html('<h3>' + correo.toUpperCase() + '</h3>');
                html =  '<tr>';
                    html += '<td>' + (d.anomalos ? d.anomalos + '%' : '0') + '</td>';
                    html += '<td>';
                        if(d.cumplimiento > 94){
                            html += '<label class="label label-success">' + d.cumplimiento + ' % </label></td>'
                        }
                        if(d.cumplimiento >= 50 && d.cumplimiento <= 94){
                            html += '<label class="label label-warning">' + d.cumplimiento + ' % </label></td>'
                        }
                        if(d.cumplimiento < 50){
                            html += '<label class="label label-warning">' + d.cumplimiento + ' % </label></td>'
                        }
                    html += '<td>' + (d.modalidad === 'D'? 'Domicilio' : 'Sucursal') + '</td>';
                    html += '<td>' + d.horas_entrega + ' hs</td>';
                    html += '<td>' + d.peso_desde + ' kg / ' + d.peso_hasta + 'kg</td>';
                    html += '<td>' + servicio + '</td>';
                    html += '<td><strong style="color: deeppink"> $' +  d.valor.replace('.', ",") + '</strong></td>';
                    html += '<td><small><strong>'
                                +  d.sucursal.nombre + '</strong>' + ' (' + d.sucursal.codigo + ')<br> '
                                +  d.sucursal.calle + ' '
                                +  d.sucursal.numero +
                            '</small></td>';
                html += '</tr>';

                table.append(html);

            });
        }

        $(".overlay").hide();
        $('#tbl-resultados-comprador').show();

    }


});