<?php
header('Content-type: text/css');  
header("Cache-Control: must-revalidate");
$offset = 72000 ;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($ExpStr);
$css = $_GET["css"];
$css = urldecode($css);
$s = explode("|", $css);
$bg_color = "$s[0]";

echo <<<CSS
body {
background-color: {$bg_color};
}
CSS
?>