<?php
echo shell_exec('./vendor/bin/phpunit tests --exclude-group wip 2>&1');
