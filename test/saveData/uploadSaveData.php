<?php
include __DIR__."/../config/config.php";
$app = new GDConfig($host, $username, $password);
$saveData = file_get_contents ("http://famryamri-g.7m.pl/allafdps/accounts/SIGMATEAM");
echo $app->uploadSaveData ($saveData);
echo $saveData;