$( window ).load(function() {


    $( '#provincia' ).change(function( event ) {
        event.preventDefault();

        $('#partido').remove();
        $('#partidoLabel').remove();
        $('#localidad').remove();
        $('#localidadLabel').remove();

        var form = $( this );
        $.ajax({
            type: 'GET',
            url: 'address/partidos',
            data: form.serialize(),
            dataType: 'json',
            success: function( resp ) {

                renderPartidosSelect(resp);

                $( '#partido' ).change(function( event ) {
                    event.preventDefault();

                    $('#localidad').remove();
                    $('#localidadLabel').remove();

                    var form = $( this );
                    $.ajax({
                        type: 'GET',
                        url: 'address/localidades',
                        data: form.serialize(),
                        dataType: 'json',
                        success: function( loc ) {
                            renderLocalidadesSelect(loc);
                        }
                    });
                });

                function renderLocalidadesSelect(loc) {

                    var html = '<label for="localidades" id="localidadLabel">Localidad</label>';
                    html += '<select name="localidad" class="form-control" id="localidad">';
                    for(var i = 0; i < loc.length; i++){
                        html += '<option value="' + loc[i].id + '">' + loc[i].localidad + '</option>';
                    }
                    html += '</select>';

                    $('#localidadDiv').append(html);
                }


            }
        });
    });


    function renderPartidosSelect(resp) {

        var html = '<label for="partidos" id="partidoLabel">Partido</label>';
        html += '<select name="partido" class="form-control" id="partido">';
        for(var i = 0; i < resp.length; i++){
            html += '<option value="' + resp[i].id + '">' + resp[i].partido + '</option>';
        }
        html += '</select>';

        $('#partidoDiv').append(html);
    }


});