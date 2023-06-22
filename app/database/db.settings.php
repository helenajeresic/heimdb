<?php

$config = require __SITE_PATH . '/app/config.php';

$db_base = 'mysql:host=localhost;dbname='.$config['rp2']['table'].';s+charset=utf8';
$db_user = $config['rp2']['user'];
$db_pass = $config['rp2']['password'];


?>