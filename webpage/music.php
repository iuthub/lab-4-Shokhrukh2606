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
$dir='songs/';
$files=glob($dir."*.mp3");
$playlists=glob($dir."*.txt");
$playlist_query=isset($_REQUEST["playlist"])?$_REQUEST['playlist']:'';


if(!empty($playlist_query)){
 $lines = file($dir.$playlist_query);
   foreach ($lines as $line) {
      print "<li class='mp3item'><a href='$dir$line'>$line</a></li>";
   }
}else{
foreach($files as $file){
$basename_of_file=basename($file);
$file_size=precised_file_size(filesize($file));

print "<li class='mp3item'><a href='$file'>$basename_of_file</a>({$file_size})</li>";
}

foreach($playlists as $playlist)    {
$basename_of_playlist=basename($playlist);
print "<li class='playlistitem'><a href='$playlist'>$basename_of_playlist</a></li>";
}
}
?>
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