// COLORES ALEATORIOS PARA FOTO DE PERFIL

var hexArray = ['#21070F','#339C9A','#0EBFBB','#088E53','#D30854','#C6FE0C','#05AD0C','#C06D21','#E7B503','#660452','#F98296','#4CB53B','#F9942A','#2EACF4','#3CDF93','#EE4029','#9AADDA','#AC683C','#5B2757','#CCA0A6','#F2836B','#4947C9','#200973','#27AFAB','#67D3CC','#2B9918','#F82998','#98678F','#C4104D','#523577','#59BBA5', '#013734', '#729C94', '#C64525', '#DBB67D', '#0F81E6', '#609126', '#7B8675', '#A00487', '#17E581', '#FA270A', '#3A6A01'];

$(".sinfoto").each(function (index){
    var randomColor = hexArray[Math.floor( Math.random() * hexArray.length )];
    $(this).css("background-color",randomColor);
});