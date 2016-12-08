$(document).ready(function () {
    var options = {
        series: {
            bars: {
                show: true,
                barWidth: 0.6,
                align: "center"
            },            
        },
        xaxis: {
            mode: "categories",
            tickLength: 0
        }
    };
    
    var data = [];

    function onDataReceived(series) {
        data = [ series ];
        $.plot("#grafico", data, options);
    }

    // Normally we call the same URL - a script connected to a
    // database - but in this case we only have static example
    // files, so we need to modify the URL.

    $.ajax({
            url: "/encuesta/index.php?controlador=encuesta&accion=jsonSimple",
            type: "GET",
            dataType: "json",
            success: onDataReceived
    });
});