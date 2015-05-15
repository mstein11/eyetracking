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
            },
            error: function(data) {
                console.log(data);
                //alert("error: cpu usage is: " + data);
            }
        })
    }

    window.setInterval(getCpuLoadFunc, 5000);

});