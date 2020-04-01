<?php
include __DIR__."/../config/config.php";
$app = new GDComment($host, $username, $password);
header ("content-type: application/json");
$app->setUserID (3023874);
print_r ($app->fetchCommentHistory());