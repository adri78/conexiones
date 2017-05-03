/**
 * Created by adri78 on 20/2/2017.
 */
function FechaSQL(fecha){
    try {
        var F = fecha.split("/");
        var tmp = F[2] + "-" + F[1] + "-" + F[0];
        return tmp;
    }
    catch(err) {
        var f=new Date();
        var ano = f.getFullYear();
        var mes = f.getMonth();
        var dia = f.getDate();
        var tmp = ano + "-" + mes  + "-" + dia ;
        return tmp;
    }
}
function DeHasta(enter,campo){
    var D= document.getElementById(enter);
    $(D).keydown(function(e){
        if (e.keyCode==13){
            e.preventDefault();
            document.getElementById(campo).focus();
            return false;
        }
    });
}

function AStock(modo,ArtID,Cant,Local){
    var d={M:modo,Local:Local,ID:ArtID,Stock:Cant};
    console.log("ver");
    console.log(d);
    $.post("cgi/Grabar.php", d, function(result){ console.log("Stock "+ result); });
}

$(function() {
    $('#side-menu').metisMenu();
});

$(function() {
    var tooltips = $( "[title]" ).tooltip({
        position: {
            my: "left top",
            at: "right+5 top-5",
            collision: "none"
        }
    });
});
/*
function crearEvento(elemento, evento, funcion) {
    if (elemento.addEventListener) {
        elemento.addEventListener(evento, funcion, false);
    } else {
        elemento.attachEvent("on" + evento, funcion);
    }
}
*/