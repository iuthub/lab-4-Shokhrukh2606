<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>
		<div id="listarea">
			<ul id="musiclist">
			 <?php 
			if(isset($_REQUEST["playlist"])){ ?>
            <?php 
			 $playlist = $_REQUEST["playlist"];
			foreach(file('songs/' . $playlist) as $line) {?>
            <li class="mp3item">
                <a href="songs/<?= $line ?>"><?= $line ?></a>
            </li>
            <?php } ?>
            <?php } else {?>

            <?php 
			 foreach (glob("songs/*.mp3") as $filename) { ?>
            <li class="mp3item">
                <a href="<?= $filename ?>"><?= basename($filename) ?></a>
                (<?= precised_file_size(filesize($filename)); ?>)
            </li>
            <?php } ?>

            <?php foreach (glob("songs/*.txt") as $filename) { ?>
            <li class="playlistitem">
                <a href="music.php?playlist=<?= basename($filename) ?>"><?= basename($filename) ?></a>
                (<?= precised_file_size(filesize($filename)); ?>) 
            </li>
            <?php } }?>
			</ul>
		</div>
	</body>
</html>

<?php
function precised_file_size($fs)
{

	$ans;
	if((0<=$fs)&&($fs<=1023)){
		$ans=$fs.' b';
		return $ans;
	}else if((1024<=$fs)&&($fs<=1048575)){
		$ans=round(($fs/1024), 2);
		return $ans.' kb';
	}else if(1048576<=$fs){
        $ans=round(($fs/1048576), 2); 
		return $ans.' mb';
	}	
}
?>