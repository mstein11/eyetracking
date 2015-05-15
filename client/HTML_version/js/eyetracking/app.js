/**
 * Created by mariusstein on 15.05.15.
 */
$(document).ready(function() {

    var getCpuLoadFunc = function() {
        $.ajax({
            url:'/api/server.php?getCpuLoad',
            method: 'GET',
            success: function(data) {
                console.log("success!: " + data)

                var html = '<div class="easy-pie-chart txt-color-orangeDark" data-percent="'+data+'" data-pie-size="50">' +
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

            },
            error: function(data) {
                console.log(data);
                //alert("error: cpu usage is: " + data);
            }
        })
    }

    window.setInterval(getCpuLoadFunc, 5000);

});