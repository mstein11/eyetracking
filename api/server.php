<?php
if (isset($_GET["getCpuLoad"])) {
    $load = sys_getloadavg();
    $load1 = ($load[0] / num_cpus());
    echo $load1;
}

if (isset($_GET["getRamUsage"])) {

    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = $mem[2]/$mem[1]*100;

    echo $memory_usage;
}

if (isset($_GET["getDiscUsage"])) {
    $disFree = disk_free_space("/");
    $diskTotal = disk_total_space("/");
    echo ($disFree / $diskTotal)* 100;
}

if (isset($_GET["files"])) {
    $os = PHP_OS;
    $cam1Dir = "/var/www/cam1/";
    $cam2Dir = "/var/www/cam1/";
    echo $os;

    $arr1[] = array();
    if ($handle1 = opendir('/www/cam1/')) {
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
    if ($handle2 = opendir('/www/cam2/')) {
        $cnt = 0;
        while (false !== ($entry = readdir($handle2))) {
            if(strlen($entry) > 4){
                $arr2[$cnt] = $entry;
                $cnt++;
            }
        }
        closedir($handle2);
    }
    $arrBoth = array();
    foreach ($arr1 as $key => $value) {
        foreach ($arr1 as $innerKey => $innerValue) {
            if ($value == $innerValue) {
                $arrBoth[] = $value;
                continue 2;
            }
        }
    }
    date_default_timezone_set('Africa/Lagos');
    $result = array();
    foreach ($arrBoth as $key => $value) {
        $element = array();
        $element["filename"] = $value;
        $element["path_cam1"] = "/cam1/" . $value;
        $element["path_cam2"] = "/cam2/" . $value;
        $element["last_modified_cam1"] = date("F d Y H:i:s.", filemtime("/www/cam1/" . $value));
        $element["last_modified_cam2"] = date("F d Y H:i:s.", filemtime("/www/cam2/" . $value));
        $result[] =  $element;
    }

    echo json_encode($result);
}


function num_cpus()
{
    $numCpus = 1;

    if (is_file('/proc/cpuinfo'))
    {
        $cpuinfo = file_get_contents('/proc/cpuinfo');
        preg_match_all('/^processor/m', $cpuinfo, $matches);

        $numCpus = count($matches[0]);
    }
    else if ('WIN' == strtoupper(substr(PHP_OS, 0, 3)))
    {
        $process = @popen('wmic cpu get NumberOfCores', 'rb');

        if (false !== $process)
        {
            fgets($process);
            $numCpus = intval(fgets($process));

            pclose($process);
        }
    }
    else
    {
        $process = @popen('sysctl -a', 'rb');

        if (false !== $process)
        {
            $output = stream_get_contents($process);

            preg_match('/hw.ncpu: (\d+)/', $output, $matches);
            if ($matches)
            {
                $numCpus = intval($matches[1][0]);
            }

            pclose($process);
        }
    }

    return $numCpus;
}

if (isset($_GET["numcpus"])) {
    echo num_cpus();
}