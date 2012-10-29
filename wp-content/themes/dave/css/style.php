<?php
header('Content-type: text/css');  
header("Cache-Control: must-revalidate");
$offset = 72000 ;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($ExpStr);
$css = $_GET["css"];
$css = urldecode($css);
$s = explode("|", $css);
//print_r($s);
$backgroundcolour = "$s[0]";
$border = "$s[1]";
$border2 = "$s[2]";
$defaultgridbg = "$s[3]";
$textcolour = "$s[4]";
$linkcolour = "$s[5]";

echo <<<CSS
body {
background-color: {$backgroundcolour};
color: {$textcolour};
}
a {
color: {$linkcolour};
}
#main {
border-color: {$border}
}
#sidebar .daveWell {
border-color: {$border}
}
#content-info {
border-color: {$border}
}
ul.sub-menu {
border-color: {$border2}
}
.post_excerpt_with_thumbnail{
	background-color: {$defaultgridbg}
}
CSS
?>