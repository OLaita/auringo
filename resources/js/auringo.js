var section = {!! json_encode($pro->financiacionActual) !!};
var meta = {!! json_encode($pro->meta) !!};
var idproj= {!! json_encode($pro->id) !!};
var porcentaje = section * 100;
var porcentaje2=porcentaje/meta;

$("#financioacion"+idproj).data("valor",porcentaje2);
$("#financioacion"+idproj).append(Math.trunc(porcentaje2)+"%");

$('.barras').each(function() {
 var dataWidth = $(this).data('valor');
 $(this).css("width", dataWidth + "%");
if (dataWidth <=25) { $(this).css("background-color", "red"); }
    else if (dataWidth >25 && dataWidth <=50){ $(this).css("background-color", "orange"); }
    else if (dataWidth >50 && dataWidth<=75) { $(this).css("background-color", "yellow"); }
    else if (dataWidth >75) { $(this).css("background-color", "green"); }
});
