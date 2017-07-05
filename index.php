<?php
#wh0ami PHP engine
#Lincesed under GPL-3.0
$includedir = "core"; //Default include dir
$debug = 0;
foreach (scandir($includedir) as $file) {
	$includefile = $includedir . "/" . $file;
	if(!is_dir($includefile)){
		if($debug){echo "Including the " . $includefile . "\n";}
     include $includefile;
	}elseif(is_dir($includefile)){
		if($debug){echo "Skipping the " . $includefile . " because is dir. \n";}
	}
}

?>