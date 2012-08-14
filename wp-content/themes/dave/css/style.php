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
$bordercolour = "$s[1]";

echo <<<CSS
body {
background-color: {$backgroundcolour};
}
#main {
border-color: {$bordercolour}
}
#sidebar .daveWell {
border-color: {$bordercolour}
}
#content-info {
border-color: {$bordercolour}
}	
CSS
?>