#!/bin/bash
#
# sudo web script allowing user www-data to run commands with root privilegs

case "$1" in 
	"start")
        echo "lass uns starten"
	sudo motion
    ;;
    "stop")
        echo "lass uns stoppen"
	/etc/init.d/motion stop
    ;;
   *) echo "ERROR: invalid parameter: $1 (for $0)"; exit 1 ;;
esac

exit 0
