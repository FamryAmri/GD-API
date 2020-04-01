<?php
include "main.php";
$levelName = $app->getLevelName();
$description = $app->getDescription();
$popularity = $app->getPopularity();
$info = $app->getInfo();
$password = $app->getPassword();
	if ($password){
		$password = $password;
		} else {
		$password = "No Password Set";
		}
?>
	<b>LevelName</b>: <?php echo $levelName;?><br>
	<b>Description</b>: <?php echo $description;?><br>
	<b>Downloads</b>: <?php echo $popularity["download"];?><br>
	<b>Likes</b>: <?php echo $popularity["likes"];?><br>
	<b>Password</b>: <?php echo $password;?><br>
	<b>Length</b>: <?php echo $info["levelLength"];?><br>
	<b>Original</b>: <?php echo $info["original"];?><br>
	<b>Uploaded</b>: <?php echo $info["uploaded"];?><br>
	<b>Updated</b>: <?php echo $info["updated"];?><br>
	<b>Version</b>: <?php echo $info["levelVersion"];?><br>
	<b>Objects</b>: <?php echo $info["object"];?><br>
	
		