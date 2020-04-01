<?php
include "../config/config.php";
$app = new GDComment ($host, $username, $password);
$app->setAccountID (2795);
print_r($app->fetchAccComment());