<?php

function randomString($longueur = 10)
{
 return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($longueur/strlen($x)) )),1,$longueur);
}

function writeAccess($header, $footer, $randomURL)
{
	$rule = "\nRedirect /$randomURL /wp-admin";
	$htaccess = file_get_contents('./.htaccess');
	$htaccess .= $header.$rule.$footer;
	file_put_contents('./.htaccess', $htaccess);
}

function deleteAccess($header, $footer, $randomURL) {
	$htaccess = file_get_contents('./.htaccess');
	$htaccess = str_replace($header, '', $htaccess);
	$htaccess = str_replace($footer, '', $htaccess);
	$htaccess = preg_replace("/\nRedirect.*/", '', $htaccess);
	file_put_contents('./.htaccess', $htaccess)

}

function sendTelegramMessage($chatID, $messaggio, $token) {

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function checkSecret($secret, $yourSecret)
{
	if ($secret === $yourSecret) { return True; }
	else { return False; }
}


// To define for telegram support
$token = "";
$chatid = "";

// To define for this script
$host = "";
$yourSecret = "";
$timeout = "60";
	
if (!checkSecret($_GET["s"], $yourSecret)) { 
	echo "Wrong secret";
	exit();
}


$randomURL = "ta-".randomString(10);
$header = "\n# BEGIN TEMP-ADMIN";
$footer = "\n#END TEMP-ADMIN";

writeAccess($header, $footer, $randomURL);
sendTelegramMessage($chatid, "Host : $host\nRandom URI access is : https://$host/$randomURL", $token);
echo "The URL was sent, please check out your messages.";
echo "Timeout : $timeout";
sleep($timeout);
deleteAccess($header, $footer, $randomURL);
echo "This URL is now unavailable";
?>
