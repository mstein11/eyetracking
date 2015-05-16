<?php
if (isset($_GET["getCpuLoad"])) {
    $load = sys_getloadavg();
    echo round($load[0], 2);
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