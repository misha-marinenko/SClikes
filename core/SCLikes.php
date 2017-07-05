<?php

$glob = array(
	'apiKey' => "ID",
	'apiKey_secret' => "ID_SECRET",
	'user' => 'your_username',
	'tracksdir' => "/home/YourUser/Music"
	);
function nodify($text)
{
	exec("notify-send -i /opt/SCLikes/soundcloud-0.png   'SoundCloud Sync:' '" . $text . "'");
}
nodify($text="Sync Starting...");
$counter = 0;

foreach (json_decode(file_get_contents("http://api.soundcloud.com/users/" . $glob['user'] . "/favorites?client_id=" . $glob["apiKey"]), true) as $key => $value) {
	/*if(!is_array($value)){
		echo $key . "=>" . $value . "\n";
	}else{
		echo $key . "=> | \n";
		print_r($value);
		
	}*/
	echo "Checking the:\n";
	echo $value['title'] . "\n";
    //if($value['downloadable']){
    	echo "Status: Downloadable! \n";
    	echo "Starting Download: \n";
    	if(!file_exists($glob['tracksdir'] . "/" . $value['title'])){
    		echo "╢";
    	        if(file_put_contents($glob['tracksdir'] . "/" . $value['title'], file_get_contents("https://api.soundcloud.com/tracks/" . $value['id'] . "/stream" . "?client_id=" . $glob["apiKey"]))){
    	        	echo "█";
                     $counter++;
    	        }else{

    	        	echo "███ //Error Downloading|| ███ ";
    	        }
    	        echo "╟ \n";
    }else{
    	echo "Sorry, I cannot download this track. Because file exists \n";
    	//nodify($text="Error while sync: Cannot download the " . $value['title'] . ". beacuse file exists");
    }
}
//}
echo "///█|█|███Execution Done!███|█|█///";
file_put_contents("current.json", json_encode(json_decode(file_get_contents("http://api.soundcloud.com/users/" . $glob['user'] . "/favorites?client_id=" . $glob["apiKey"]))));
nodify($text="Sync Done! Happy Listening! Downloaded: " . $counter . " Tracks.");

?>