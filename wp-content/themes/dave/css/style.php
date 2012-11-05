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
$headerurl = "$s[6]";

echo <<<CSS
/* =============================================================================
   Base
   ========================================================================== */
body { background-color: {$backgroundcolour}; color: {$textcolour}; margin:0; font-family:"Helvetica Neue",Helvetica,Arial,sans-serif; font-size:13px; line-height:18px; }
a { text-decoration:none; color: {$linkcolour}; }
a:hover { color: {$linkcolour}; text-decoration:underline; }
h1{	font-size:16px; font-weight:bold; line-height:16px; padding-bottom:16px; }
p {	margin:0; }

/* =============================================================================
   Header
   ========================================================================== */
.brand { height:100px;
	color:$textcolour;
	line-height: 40px;
	text-decoration: none;
	margin:0;
	background-repeat:no-repeat; }
a.brand span.name{ text-transform:uppercase;
	font-size: 24px;
	font-weight:bold;
	//font-stretch:extra-condensed;
	font-stretch:narrower; }
a.brand span.description{ font-size: 18px; font-style:italic; }
a.brand:hover{ color:#111; }
.hiddenleft { position:absolute; left:-10000px;	}
#banner { height:110px;	}

/* =============================================================================
   Sidebar
   ========================================================================== */

#sidebar { 
	min-height:140px;
	font-size:16px;
	//width: 220px;
}
#sidebar .daveWell {
	min-height: 20px;
	padding: 20px 19px;
	margin-bottom: 20px;
	border-top: 1px solid;
	border-color: {$border};
}
ul.menu,
ul.menu ul { list-style:none; }
ul.menu ul li { font-size:14px;	}
ul.menu a { color:#000; }
ul.menu a:hover { text-decoration:none;	color:#333; }
ul.sub-menu {
	margin-left:0px;
	padding-left:13px;
	border-top:1px solid #e5e5e5;
	border-bottom:1px solid #e5e5e5;
	border-color: {$border2};
}

/* =============================================================================
   Content
   ========================================================================== */

#main {
	border-color: {$border};
	border-top: 1px solid;
	padding-top:20px;
	padding-bottom:20px;
}

/* =============================================================================
   Footer
   ========================================================================== */

#content-info { border-color: {$border}; padding: 35px 0 36px; border-top: 0; }
#content-info p small { font-size: 13px; }

/* =============================================================================
   Posts
   ========================================================================== */

.hentry header { }
.hentry h2 a { text-decoration: none; }
.hentry time { display: block; }
.hentry p.byline { }
.hentry footer { clear: both; }
.entry-content img{ padding-bottom:20px; }

/* =============================================================================
   Post Grid
   ========================================================================== */
.postColumn{ float:left; position:relative; }
.post_excerpt_with_thumbnail{
	position:relative;
	overflow:hidden;
	background-color: {$defaultgridbg};
}
.post_excerpt_with_thumbnail h4{
	display:block;
	position:absolute;
	visibility:hidden;
	background-color:#EEE;
	bottom:0;
	width:100%;
	height:100%;
	text-align:left;
	padding:30px 20px 30px 20px;
	line-height:15px;
	-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	-moz-box-sizing: border-box;    /* Firefox, other Gecko */
	box-sizing: border-box;         /* Opera/IE 8+ */
}
.post_excerpt_with_thumbnail h3{
	display:block;
	width:100%;
	text-align:left;
	padding:30px 20px 30px 20px;
	-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	-moz-box-sizing: border-box;    /* Firefox, other Gecko */
	box-sizing: border-box;         /* Opera/IE 8+ */
}

.post_excerpt_with_thumbnail h3{
	text-decoration:none;
	font-size:14px; 
}

/* =============================================================================
   Post Comments
   ========================================================================== */

#comments, #respond, #submit { clear: both; display: block; }
ol.commentlist img.avatar { float: left; margin-right: 10px; }

/* =============================================================================
   WordPress Generated Classes
   See: http://codex.wordpress.org/CSS#WordPress_Generated_Classes
   ========================================================================== */

.aligncenter { display: block; margin: 0 auto; }
.alignleft { margin: 0 20px 20px 0; float: left; }
.alignright { margin: 0 0 20px 20px; float: right; }

CSS
?>