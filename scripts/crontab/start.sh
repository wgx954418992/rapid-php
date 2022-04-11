#!/bin/bash

source $(ls ~/.bash_profile /etc/profile 2> /dev/null)

currentPath=$(cd $(dirname $0); pwd)

php -f "${currentPath}/index.php" $* >> "${currentPath}/crontab.log"