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
$textcolour2 = "$s[5]";
$linkcolour = "$s[6]";

echo <<<CSS
/* =============================================================================
   Grid 960
   ========================================================================== */
.row{margin-left:-20px;*zoom:1}
.row:before,.row:after{display:table;content:""}
.row:after{clear:both}
[class*="span"]{float:left;margin-left:20px}
.container,.navbar-fixed-top .container,.navbar-fixed-bottom .container{width:940px}
.span12{width:940px}
.span11{width:860px}
.span10{width:780px}
.span9{width:700px}
.span8{width:620px}
.span7{width:540px}
.span6{width:460px}
.span5{width:380px}
.span4{width:300px}
.span3{width:220px}
.span2{width:140px}
.span1{width:60px}
.offset12{margin-left:980px}
.offset11{margin-left:900px}
.offset10{margin-left:820px}
.offset9{margin-left:740px}
.offset8{margin-left:660px}
.offset7{margin-left:580px}
.offset6{margin-left:500px}
.offset5{margin-left:420px}
.offset4{margin-left:340px}
.offset3{margin-left:260px}
.offset2{margin-left:180px}
.offset1{margin-left:100px}

/* =============================================================================
   Icons
   ========================================================================== */

[class^="icon-"],[class*=" icon-"]{display:inline-block;width:14px;height:14px;*margin-right:.3em;line-height:14px;vertical-align:text-top;background-image:url("/img/glyphicons-halflings.png");background-position:14px 14px;background-repeat:no-repeat}
[class^="icon-"]:last-child,[class*=" icon-"]:last-child{*margin-left:0}
.icon-white{background-image:url("/img/glyphicons-halflings-white.png")}
.icon-glass{background-position:0 0}
.icon-music{background-position:-24px 0}
.icon-search{background-position:-48px 0}
.icon-envelope{background-position:-72px 0}
.icon-heart{background-position:-96px 0}
.icon-star{background-position:-120px 0}
.icon-star-empty{background-position:-144px 0}
.icon-user{background-position:-168px 0}
.icon-film{background-position:-192px 0}
.icon-th-large{background-position:-216px 0}
.icon-th{background-position:-240px 0}
.icon-th-list{background-position:-264px 0}
.icon-ok{background-position:-288px 0}
.icon-remove{background-position:-312px 0}
.icon-zoom-in{background-position:-336px 0}
.icon-zoom-out{background-position:-360px 0}
.icon-off{background-position:-384px 0}
.icon-signal{background-position:-408px 0}
.icon-cog{background-position:-432px 0}
.icon-trash{background-position:-456px 0}
.icon-home{background-position:0 -24px}
.icon-file{background-position:-24px -24px}
.icon-time{background-position:-48px -24px}
.icon-road{background-position:-72px -24px}
.icon-download-alt{background-position:-96px -24px}
.icon-download{background-position:-120px -24px}
.icon-upload{background-position:-144px -24px}
.icon-inbox{background-position:-168px -24px}
.icon-play-circle{background-position:-192px -24px}
.icon-repeat{background-position:-216px -24px}
.icon-refresh{background-position:-240px -24px}
.icon-list-alt{background-position:-264px -24px}
.icon-lock{background-position:-287px -24px}
.icon-flag{background-position:-312px -24px}
.icon-headphones{background-position:-336px -24px}
.icon-volume-off{background-position:-360px -24px}
.icon-volume-down{background-position:-384px -24px}
.icon-volume-up{background-position:-408px -24px}
.icon-qrcode{background-position:-432px -24px}
.icon-barcode{background-position:-456px -24px}
.icon-tag{background-position:0 -48px}
.icon-tags{background-position:-25px -48px}
.icon-book{background-position:-48px -48px}
.icon-bookmark{background-position:-72px -48px}
.icon-print{background-position:-96px -48px}
.icon-camera{background-position:-120px -48px}
.icon-font{background-position:-144px -48px}
.icon-bold{background-position:-167px -48px}
.icon-italic{background-position:-192px -48px}
.icon-text-height{background-position:-216px -48px}
.icon-text-width{background-position:-240px -48px}
.icon-align-left{background-position:-264px -48px}
.icon-align-center{background-position:-288px -48px}
.icon-align-right{background-position:-312px -48px}
.icon-align-justify{background-position:-336px -48px}
.icon-list{background-position:-360px -48px}
.icon-indent-left{background-position:-384px -48px}
.icon-indent-right{background-position:-408px -48px}
.icon-facetime-video{background-position:-432px -48px}
.icon-picture{background-position:-456px -48px}
.icon-pencil{background-position:0 -72px}
.icon-map-marker{background-position:-24px -72px}
.icon-adjust{background-position:-48px -72px}
.icon-tint{background-position:-72px -72px}
.icon-edit{background-position:-96px -72px}
.icon-share{background-position:-120px -72px}
.icon-check{background-position:-144px -72px}
.icon-move{background-position:-168px -72px}
.icon-step-backward{background-position:-192px -72px}
.icon-fast-backward{background-position:-216px -72px}
.icon-backward{background-position:-240px -72px}
.icon-play{background-position:-264px -72px}
.icon-pause{background-position:-288px -72px}
.icon-stop{background-position:-312px -72px}
.icon-forward{background-position:-336px -72px}
.icon-fast-forward{background-position:-360px -72px}
.icon-step-forward{background-position:-384px -72px}
.icon-eject{background-position:-408px -72px}
.icon-chevron-left{background-position:-432px -72px}
.icon-chevron-right{background-position:-456px -72px}
.icon-plus-sign{background-position:0 -96px}
.icon-minus-sign{background-position:-24px -96px}
.icon-remove-sign{background-position:-48px -96px}
.icon-ok-sign{background-position:-72px -96px}
.icon-question-sign{background-position:-96px -96px}
.icon-info-sign{background-position:-120px -96px}
.icon-screenshot{background-position:-144px -96px}
.icon-remove-circle{background-position:-168px -96px}
.icon-ok-circle{background-position:-192px -96px}
.icon-ban-circle{background-position:-216px -96px}
.icon-arrow-left{background-position:-240px -96px}
.icon-arrow-right{background-position:-264px -96px}
.icon-arrow-up{background-position:-289px -96px}
.icon-arrow-down{background-position:-312px -96px}
.icon-share-alt{background-position:-336px -96px}
.icon-resize-full{background-position:-360px -96px}
.icon-resize-small{background-position:-384px -96px}
.icon-plus{background-position:-408px -96px}
.icon-minus{background-position:-433px -96px}
.icon-asterisk{background-position:-456px -96px}
.icon-exclamation-sign{background-position:0 -120px}
.icon-gift{background-position:-24px -120px}
.icon-leaf{background-position:-48px -120px}
.icon-fire{background-position:-72px -120px}
.icon-eye-open{background-position:-96px -120px}
.icon-eye-close{background-position:-120px -120px}
.icon-warning-sign{background-position:-144px -120px}
.icon-plane{background-position:-168px -120px}
.icon-calendar{background-position:-192px -120px}
.icon-random{background-position:-216px -120px}
.icon-comment{background-position:-240px -120px}
.icon-magnet{background-position:-264px -120px}
.icon-chevron-up{background-position:-288px -120px}
.icon-chevron-down{background-position:-313px -119px}
.icon-retweet{background-position:-336px -120px}
.icon-shopping-cart{background-position:-360px -120px}
.icon-folder-close{background-position:-384px -120px}
.icon-folder-open{background-position:-408px -120px}
.icon-resize-vertical{background-position:-432px -119px}
.icon-resize-horizontal{background-position:-456px -118px}
.icon-hdd{background-position:0 -144px}
.icon-bullhorn{background-position:-24px -144px}
.icon-bell{background-position:-48px -144px}
.icon-certificate{background-position:-72px -144px}
.icon-thumbs-up{background-position:-96px -144px}
.icon-thumbs-down{background-position:-120px -144px}
.icon-hand-right{background-position:-144px -144px}
.icon-hand-left{background-position:-168px -144px}
.icon-hand-up{background-position:-192px -144px}
.icon-hand-down{background-position:-216px -144px}
.icon-circle-arrow-right{background-position:-240px -144px}
.icon-circle-arrow-left{background-position:-264px -144px}
.icon-circle-arrow-up{background-position:-288px -144px}
.icon-circle-arrow-down{background-position:-312px -144px}
.icon-globe{background-position:-336px -144px}
.icon-wrench{background-position:-360px -144px}
.icon-tasks{background-position:-384px -144px}
.icon-filter{background-position:-408px -144px}
.icon-briefcase{background-position:-432px -144px}
.icon-fullscreen{background-position:-456px -144px}


/* =============================================================================
   Bootstrap
   ========================================================================== */
.container{margin-left:10px;}
.container:before,.container:after{display:table;content:""}
.container:after{clear:both}

.alert{padding:8px 35px 8px 14px;margin-bottom:18px;color:#c09853;text-shadow:0 1px 0 rgba(255,255,255,0.5);background-color:#fcf8e3;border:1px solid #fbeed5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.alert-heading{color:inherit}
.alert .close{position:relative;top:-2px;right:-21px;line-height:18px}
.alert-success{color:#468847;background-color:#dff0d8;border-color:#d6e9c6}
.alert-danger,.alert-error{color:#b94a48;background-color:#f2dede;border-color:#eed3d7}
.alert-info{color:#3a87ad;background-color:#d9edf7;border-color:#bce8f1}
.alert-block{padding-top:14px;padding-bottom:14px}
.alert-block>p,.alert-block>ul{margin-bottom:0}
.alert-block p+p{margin-top:5px}
.close{float:right;font-size:20px;font-weight:bold;line-height:18px;color:#000;text-shadow:0 1px 0 #fff;opacity:.2;filter:alpha(opacity=20)}
.close:hover{color:#000;text-decoration:none;cursor:pointer;opacity:.4;filter:alpha(opacity=40)}

.well{min-height:20px;padding:19px;margin-bottom:20px;background-color:#f5f5f5;border:1px solid #eee;border:1px solid rgba(0,0,0,0.05);-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);box-shadow:inset 0 1px 1px rgba(0,0,0,0.05)}
.well blockquote{border-color:#ddd;border-color:rgba(0,0,0,0.15)}
.well-large{padding:24px;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px}
.well-small{padding:9px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}
.fade{opacity:0;filter:alpha(opacity=0);-webkit-transition:opacity .15s linear;-moz-transition:opacity .15s linear;-ms-transition:opacity .15s linear;-o-transition:opacity .15s linear;transition:opacity .15s linear}
.fade.in{opacity:1;filter:alpha(opacity=100)}
.search-query{padding-right:14px;padding-right:4px \9;padding-left:14px;padding-left:4px \9;margin-bottom:0;-webkit-border-radius:14px;-moz-border-radius:14px;border-radius:14px}
input,textarea,select,.uneditable-input{display:inline-block;width:210px;height:18px;padding:4px;margin-bottom:9px;font-size:13px;line-height:18px;color:#555;background-color:#fff;border:1px solid #ccc;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}
.form-search input,.form-inline input,.form-horizontal input,.form-search textarea,.form-inline textarea,.form-horizontal textarea,.form-search select,.form-inline select,.form-horizontal select,.form-search .help-inline,.form-inline .help-inline,.form-horizontal .help-inline,.form-search .uneditable-input,.form-inline .uneditable-input,.form-horizontal .uneditable-input,.form-search .input-prepend,.form-inline .input-prepend,.form-horizontal .input-prepend,.form-search .input-append,.form-inline .input-append,.form-horizontal .input-append{display:inline-block;*display:inline;margin-bottom:0;*zoom:1}
textarea { overflow: auto; vertical-align: top; resize: vertical; }
label input,label textarea,label select{display:block}
input[type="image"],input[type="checkbox"],input[type="radio"]{width:auto;height:auto;padding:0;margin:3px 0;*margin-top:0;line-height:normal;cursor:pointer;background-color:transparent;border:0 \9;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}
input[type="image"]{border:0}
input[type="file"]{width:auto;padding:initial;line-height:initial;background-color:#fff;background-color:initial;border:initial;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
input[type="button"],input[type="reset"],input[type="submit"]{width:auto;height:auto}
input:invalid, textarea:invalid { background-color: #f0dddd; }
.btn{border-color:#ccc;border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25)}
button.close{padding:0;cursor:pointer;background:transparent;border:0;-webkit-appearance:none}
.btn{display:inline-block;*display:inline;padding:4px 10px 4px;margin-bottom:0;*margin-left:.3em;font-size:13px;line-height:18px;*line-height:20px;color:#333;text-align:center;text-shadow:0 1px 1px rgba(255,255,255,0.75);vertical-align:middle;cursor:pointer;background-color:#f5f5f5;*background-color:#e6e6e6;background-image:-ms-linear-gradient(top,#fff,#e6e6e6);background-image:-webkit-gradient(linear,0 0,0 100%,from(#fff),to(#e6e6e6));background-image:-webkit-linear-gradient(top,#fff,#e6e6e6);background-image:-o-linear-gradient(top,#fff,#e6e6e6);background-image:linear-gradient(top,#fff,#e6e6e6);background-image:-moz-linear-gradient(top,#fff,#e6e6e6);background-repeat:repeat-x;border:1px solid #ccc;*border:0;border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;filter:progid:dximagetransform.microsoft.gradient(startColorstr='#ffffff',endColorstr='#e6e6e6',GradientType=0);filter:progid:dximagetransform.microsoft.gradient(enabled=false);*zoom:1;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);box-shadow:inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05)}
.btn:hover,.btn:active,.btn.active,.btn.disabled,.btn[disabled]{background-color:#e6e6e6;*background-color:#d9d9d9}
.btn:active,.btn.active{background-color:#ccc \9}
.btn:first-child{*margin-left:0}
.btn:hover{color:#333;text-decoration:none;background-color:#e6e6e6;*background-color:#d9d9d9;background-position:0 -15px;-webkit-transition:background-position .1s linear;-moz-transition:background-position .1s linear;-ms-transition:background-position .1s linear;-o-transition:background-position .1s linear;transition:background-position .1s linear}
.btn:focus{outline:thin dotted #333;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}
.btn.active,.btn:active{background-color:#e6e6e6;background-color:#d9d9d9 \9;background-image:none;outline:0;-webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);-moz-box-shadow:inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);box-shadow:inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05)}

table { border-collapse: collapse; border-spacing: 0; }
td { vertical-align: top; }

/* =============================================================================
   Base
   ========================================================================== */
body { background-color: {$backgroundcolour}; color: {$textcolour}; margin:0; font-family:"Helvetica Neue",Helvetica,Arial,sans-serif; font-size:13px; line-height:18px; }
a { text-decoration:none; color: {$linkcolour}; }
a:hover { color: {$linkcolour}; text-decoration:underline; }
p{margin:0 0 9px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:13px;line-height:18px}
p small{font-size:11px;color:#999}
h1,h2,h3,h4,h5,h6{margin:0;font-family:inherit;font-weight:bold;color:inherit;text-rendering:optimizelegibility}
h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-weight:normal;color:#999}
h1{	font-size:16px; font-weight:bold; line-height:16px; padding-bottom:16px; }
h1 small{font-size:18px}
h2{font-size:24px;line-height:36px}
h2 small{font-size:18px}
h3{font-size:18px;line-height:27px}
h3 small{font-size:14px}
h4,h5,h6{line-height:18px}
h4{font-size:14px}
h4 small{font-size:12px}
h5{font-size:12px}
h6{font-size:11px;color:#999;text-transform:uppercase}
.page-header{padding-bottom:17px;margin:18px 0;border-bottom:1px solid #eee}
.page-header h1{line-height:1}

/* =============================================================================
   Header
   ========================================================================== */
.brand { height:110px;
	color:$textcolour;
	line-height: 40px;
	text-decoration: none;
	margin:0;
	background-repeat:no-repeat; 
	position:fixed;	
}
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
	position:fixed;
}
#sidebar .daveWell {
	min-height: 20px;
	padding: 20px 19px;
	margin-bottom: 20px;
	border-top: 1px solid;
	border-color: {$border};
}
ul.menu,
ul.menu ul { list-style:none; padding-top:10px; padding-bottom:10px; margin-top:5px; margin-bottom:5px;  }
ul.menu ul li { font-size:12px;	line-height:20px; }
ul.menu ul li a{ color:{$textcolour2}; }
ul.menu ul li.active a{ color:{$textcolour}; }
ul.menu li { font-size:16px;	line-height:24px; }
ul.menu a { color:#000; }
ul.menu a:hover { text-decoration:none;	color:#333; }
ul.sub-menu {
	margin-left:0px;
	padding-left:13px;
	border-top:1px solid #e5e5e5;
	border-bottom:1px solid #e5e5e5;
	border-color: {$border2};
}
ul,ol{padding:0;margin:0 0 9px 0}
ul ul,ul ol,ol ol,ol ul{margin-bottom:0}
ul{list-style:disc}
ol{list-style:decimal}
li{line-height:18px}
ul.unstyled,ol.unstyled{margin-left:0;list-style:none}

/* =============================================================================
   Content
   ========================================================================== */

#main {
	border-color: {$border};
	border-top: 1px solid;
	padding-top:20px;
	padding-bottom:20px;
	margin-left: 260px;
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
.entry-content img{ padding-bottom:20px }
.entry-content { padding-bottom:40px; border-bottom:solid $border 1px; margin-bottom:60px; }

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