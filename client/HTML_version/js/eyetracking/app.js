/**
 * Created by mariusstein on 15.05.15.
 */
$(document).ready(function() {
    var cpuPieChart;
    var ramPieChart;
    var getCpuLoadFunc = function() {
        $.ajax({
            url:'/api/server.php?getCpuLoad',
            method: 'GET',
            success: function(data) {
                console.log("success!: " + data)

                if (!cpuPieChart) {
                    var html = '<div class="easy-pie-chart cpu-usage-pie-chart txt-color-orangeDark" data-percent="'+data+'" data-pie-size="25">' +
                        '<span class="percent percent-sign">' + data + '</span>' +
                        '</div>' +
                        '<span class="easy-pie-title"> Server Load <i class="fa fa-caret-up icon-color-bad"></i> </span> ';
                    $('#cpu-load').html(html);
                    cpuPieChart = $('.cpu-usage-pie-chart');
                    cpuPieChart.easyPieChart(
                        {
                            "trackColor":"rgba(0,0,0,0.04)",
                            "scaleColor":!1,
                            "lineCap":"butt",
                            "lineWidth":parseInt(26/8.5),
                            "animate":1500,
                            "rotate":-90,
                            "size":50,
                            "onStep":function(a,b,c){
                                $(this.el).find(".percent").text(Math.round(c*100)/100)
                            }
                        }
                    );
                } else {
                    console.log(data)
                    cpuPieChart.data('easyPieChart').update(data);
                }

            },
            error: function(data) {
                console.log(data);
                //alert("error: cpu usage is: " + data);
            }
        })
    }

    var getRamUsage = function() {
        $.ajax({
            url:'/api/server.php?getRamUsage',
            method: 'GET',
            success: function(data) {
                console.log("success!: " + data)

                if (!ramPieChart) {
                    var html = '<div class="easy-pie-chart ram-usage-pie-chart txt-color-orangeDark" data-percent="'+data+'" data-pie-size="25">' +
                        '<span class="percent percent-sign">' + data + '</span>' +
                        '</div>' +
                        '<span class="easy-pie-title"> Server Load <i class="fa fa-caret-up icon-color-bad"></i> </span> ';
                    $('#ram-usage').html(html);
                    ramPieChart = $('.cpu-usage-pie-chart');
                    ramPieChart.easyPieChart(
                        {
                            "trackColor":"rgba(0,0,0,0.04)",
                            "scaleColor":!1,
                            "lineCap":"butt",
                            "lineWidth":parseInt(26/8.5),
                            "animate":1500,
                            "rotate":-90,
                            "size":50,
                            "onStep":function(a,b,c){
                                $(this.el).find(".percent").text(Math.round(c*100)/100)
                            }
                        }
                    );
                } else {
                    ramPieChart.data('easyPieChart').update(data);
                }

            },
            error: function(data) {
                console.log(data);
                //alert("error: cpu usage is: " + data);
            }

        });
    }

    window.setInterval(getCpuLoadFunc, 5000);
    window.setInterval(getRamUsage, 5000);

});