<?php

if (isset($GET["getCpuLoad"])) {
    $load = sys_getloadavg();
    echo $load[0];
}