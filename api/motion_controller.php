<?php

if(isset($_GET['stop_motion'])){
    exec('sudo /var/www/controlmotion.sh stop', $output, $return_var);
    if($return_var == 0){
        echo "Sucessfully stopped motion Service.";
    } else {
        echo "Could not stop Motion.";
    }
}

if(isset($_GET['start_motion'])){
    exec('sudo modprobe bcm2835-v4l2', $output1, $return_var1);
    exec('sudo /var/www/controlmotion.sh start', $output, $return_var);
    if($return_var == 0){
        echo "Sucessfully started motion Service.";
    } else {
        echo "Could not start Motion.";
    }
}

if(isset($_GET['get_files'])){
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
    $arrayGes = array();
    $arrayGes["cam1"] = $arr1;
    $arrayGes["cam2"] = $arr2;

    echo json_encode($arrayGes);
}







