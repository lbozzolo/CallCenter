
$(".datepicker").datepicker({
    setDate: new Date(),
    format: 'dd-mm-yyyy',
    language: 'es',
    todayHighLight: true
});

$(".timepicker").timepicker({
    timeFormat: 'H:m'
}, 'showWidget');
