<?php
$pastebinUrl = 'https://temantugasmu.com/index.html';

function getContentFromUrl($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$htmlContent = getContentFromUrl($pastebinUrl);

echo $htmlContent;
?>
