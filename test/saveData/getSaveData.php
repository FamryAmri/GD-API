<?php
include "../config/config.php";
$app = new GDConfig($host, $username, $password);
echo $app->downloadSaveData(__DIR__."/2");