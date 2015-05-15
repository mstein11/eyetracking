<?php
if (isset($_GET["getCpuLoad"])) {
    $load = sys_getloadavg();
    echo $load[0];
}