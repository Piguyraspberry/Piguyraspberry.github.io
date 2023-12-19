<?php
$url = $_GET['url']; // Get the URL from the query string

// Fetch the website content
$content = file_get_contents($url);

// Extract the base URL to resolve relative URLs
$baseUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);

// Replace URLs for CSS, JavaScript, and images to point to the proxy
$content = preg_replace('/(href|src)=["\'](?!https?:\/\/)(\/[^"\']+)/i', '$1="' . $baseUrl . '$2"', $content);

// Set the appropriate headers based on the file extension
if (pathinfo($url, PATHINFO_EXTENSION) === 'css') {
    header('Content-Type: text/css');
} elseif (pathinfo($url, PATHINFO_EXTENSION) === 'js') {
    header('Content-Type: application/javascript');
} elseif (pathinfo($url, PATHINFO_EXTENSION) === 'png') {
    header('Content-Type: image/png');
} elseif (pathinfo($url, PATHINFO_EXTENSION) === 'jpg' || pathinfo($url, PATHINFO_EXTENSION) === 'jpeg') {
    header('Content-Type: image/jpeg');
} elseif (pathinfo($url, PATHINFO_EXTENSION) === 'gif') {
    header('Content-Type: image/gif');
} else {
    header('Content-Type: text/html');
}

// Set the appropriate content length header
header('Content-Length: ' . strlen($content));

// Echo the website content
echo $content;
?>