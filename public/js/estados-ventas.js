var hexArray = [];
hexArray['iniciada'] = '#013734';
hexArray['programada'] = '#037AF9';
hexArray['cancelada'] = '#D13634';
hexArray['auditada'] = '#729C94';
hexArray['confirmada'] = '#0EBFBB';
hexArray['rechazada'] = '#088E53';
hexArray['cobrada'] = '#D30854';
hexArray['facturada'] = '#C6FE0C';
hexArray['enviada'] = '#05AD0C';
hexArray['entregado'] = '#C06D21';
hexArray['noentregado'] = '#E7B503';
hexArray['devuelto'] = '#660452';

$(".estadoVentas").each(function (index){
    switch($(this).attr('data-estado')) {
        case 'iniciada':
            $(this).css("background-color",hexArray['iniciada']);
            break;
        case 'programada':
            $(this).css("background-color",hexArray['programada']);
            break;
        case 'cancelada':
            $(this).css("background-color", hexArray['cancelada']);
            break;
        case 'auditada':
            $(this).css("background-color",hexArray['auditada']);
            break;
        case 'confirmada':
            $(this).css("background-color",hexArray['confirmada']);
            break;
        case 'rechazada':
            $(this).css("background-color",'orangered');
            break;
        case 'cobrada':
            $(this).css("background-color",hexArray['cobrada']);
            break;
        case 'facturada':
            $(this).css("background-color",hexArray['rechazada']);
            break;
        case 'enviada':
            $(this).css("background-color",hexArray['enviada']);
            break;
        case 'entregado':
            $(this).css("background-color",hexArray['entregado']);
            break;
        case 'no.entregado':
            $(this).css("background-color",hexArray['noentregado']);
            break;
        case 'devuelto':
            $(this).css("background-color",hexArray['devuelto']);
            break;
        default:
            $(this).css("background-color",'gray');
    }

});
