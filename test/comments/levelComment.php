<?php
include "../config/config.php";
$app = new GDComment ($host, $username, $password);
echo json_encode ($app->fetchComment (10565740));