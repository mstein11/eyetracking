<?php
//$app = new Phalcon\Mvc\Micro();
?>
<html>
<head>
    <link href="video-js/video-js.css" rel="stylesheet">
    <script src="video-js/video.js"></script>
    <script>
        videojs.options.flash.swf = "video-js/video-js.swf"
    </script>
</head>
<body>


<a href="test.php?start_motion=yes">Start Motion Service</a>
<br>
<a href="test.php?stop_motion=yes">Stop Motion Service</a>



<?php
if(isset($_GET['stop_motion'])){
    echo "<pre>Trying to stop Motion software.</pre>";
    exec('sudo /var/www/controlmotion.sh stop', $output, $return_var);
    if($return_var == 0){
        echo "<pre>Sucessfully stopped motion Service.</pre>";
    } else {
        echo "<pre>Could not stop Motion.</pre>";
    }
}

if(isset($_GET['start_motion'])){
    echo "<pre>Trying to start Motion software.</pre>";
    exec('sudo modprobe bcm2835-v4l2', $output1, $return_var1);
    exec('sudo /var/www/controlmotion.sh start', $output, $return_var);
    if($return_var == 0){
        echo "<pre>Sucessfully started motion Service.</pre>";
    } else {
        echo "<pre>Could not start Motion.</pre>";
    }
}

$arr1[] = array();
if ($handle1 = opendir('/var/www/cam1/')) {
    $cnt = 0;
    while (false !== ($entry = readdir($handle1))) {
        if(strlen($entry) > 4){
            $arr1[$cnt] = $entry;
            $cnt++;
        }
    }
    closedir($handle1);
}
$arr2[] = array();
if ($handle2 = opendir('/var/www/cam2/')) {
    $cnt = 0;
    while (false !== ($entry = readdir($handle2))) {
        if(strlen($entry) > 4){
            $arr2[$cnt] = $entry;
            $cnt++;
        }
    }
    closedir($handle2);
}

echo "<table><tbody><tr><th>Camera 1</th><th>Camera 2</th></tr>";

?>




<?php

$cnt = 0;
foreach ($arr1 as $value) {
    echo "<tr>";
    if($value){
        echo "<td><a target=\"_blank\" href=\"cam1\\".$value."\">cam1\\".$value."</a></td>";
    }
    if($arr2[$cnt]){
        echo "<td><a target=\"_blank\" href=\"cam2\\".$arr2[$cnt]."\">cam2\\".$arr2[$cnt]."</a></td>";
    }
    echo "</tr>";
    $cnt++;
}
echo "</tbody></table>";
?>



</body>
</html>







