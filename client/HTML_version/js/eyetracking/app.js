/**
 * Created by mariusstein on 15.05.15.
 */
$(document).ready(function() {
    var isCpuDrawnOnce = false;
    var getCpuLoadFunc = function() {
        $.ajax({
            url:'/api/server.php?getCpuLoad',
            method: 'GET',
            success: function(data) {
                console.log("success!: " + data)

                if (!isCpuDrawnOnce) {


                    var html = '<div class="easy-pie-chart cpu-usage-pie-chart txt-color-orangeDark" data-percent="'+data+'" data-pie-size="50">' +
                        '<span class="percent percent-sign">' + data + '</span>' +
                        '</div>' +
                        '<span class="easy-pie-title"> Server Load <i class="fa fa-caret-up icon-color-bad"></i> </span> ' +
                        '<ul class="smaller-stat hidden-sm pull-right"> ' +
                        '<li> ' +
                        '<span class="label bg-color-greenLight"><i class="fa fa-caret-up"></i> 97%</span> ' +
                        '</li> ' +
                        '<li> ' +
                        '<span class="label bg-color-blueLight"><i class="fa fa-caret-down"></i> 44%</span> ' +
                        '</li> ' +
                        '</ul>';

                    $('#cpu-load').html(html);

                    $('.cpu-usage-pie-chart').easyPieChart(
                    {
                        //"barColor":$('#cpu-usage-pie-chart').css(color),
                        "trackColor":"rgba(0,0,0,0.04)",
                        "scaleColor":!1,
                        "lineCap":"butt",
                        "lineWidth":parseInt(26/8.5),
                        "animate":1500,
                        "rotate":-90,
                        "size":parseInt(25/8.5)
                        //"onStep":function(a,b,c){
                        //    $(this.el).find(".percent").text(Math.round(c))
                        //}
                    }
                    );

                    isCpuDrawnOnce = !isCpuDrawnOnce;
                }

            },
            error: function(data) {
                console.log(data);
                //alert("error: cpu usage is: " + data);
            }
        })
    }

    window.setInterval(getCpuLoadFunc, 5000);
    //$(".easy-pie-chart").each(function(){
    //    var a=$(this),
    //        b=a.css("color")||a.data("pie-color"),
    //        c=a.data("pie-track-color")||"rgba(0,0,0,0.04)",
    //        d=parseInt(a.data("pie-size"))||25;
    //}
    //a.easyPieChart({"barColor":b,"trackColor":c,"scaleColor":!1,"lineCap":"butt","lineWidth":parseInt(d/8.5),"animate":1500,"rotate":-90,"size":d,"onStep":function(a,b,c){$(this.el).find(".percent").text(Math.round(c))}})


});