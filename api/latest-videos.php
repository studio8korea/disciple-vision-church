<?php
declare(strict_types=1);

// Public YouTube RSS -> same-origin JSON. No API key or database is required.
// Intended for PHP 8.x on Cafe24 / XAMPP. YouTube controls embed permissions.
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=300');
header('X-Content-Type-Options: nosniff');

$channelId = 'UCRYv7HJiCJ1Fg8tqj9hLqxw';
$cacheFile = sys_get_temp_dir() . '/jvc_youtube_' . hash('sha256', $channelId) . '.json';
$cacheTtl = 900;

if (is_file($cacheFile) && (time() - (int) filemtime($cacheFile)) < $cacheTtl) {
    $cached = @file_get_contents($cacheFile);
    if (is_string($cached) && json_decode($cached, true) !== null) {
        echo $cached;
        exit;
    }
}

$feedUrl = 'https://www.youtube.com/feeds/videos.xml?channel_id=' . rawurlencode($channelId);
$xmlText = false;
if (function_exists('curl_init')) {
    $curl = curl_init($feedUrl);
    if ($curl !== false) {
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 9,
            CURLOPT_USERAGENT => 'JejaVisionChurch/1.0 (+public YouTube feed)',
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        $xmlText = curl_exec($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            $xmlText = false;
        }
        curl_close($curl);
    }
} elseif (filter_var(ini_get('allow_url_fopen'), FILTER_VALIDATE_BOOLEAN)) {
    $xmlText = @file_get_contents($feedUrl);
}

$items = [];
if (is_string($xmlText) && $xmlText !== '' && function_exists('simplexml_load_string')) {
    $feed = @simplexml_load_string($xmlText, 'SimpleXMLElement', LIBXML_NONET);
    if ($feed !== false) {
        $ytNamespace = 'http://www.youtube.com/xml/schemas/2015';
        foreach ($feed->entry as $entry) {
            $youtube = $entry->children($ytNamespace);
            $id = trim((string) $youtube->videoId);
            if (!preg_match('/^[A-Za-z0-9_-]{11}$/', $id)) {
                continue;
            }
            $items[] = [
                'id' => $id,
                'title' => trim((string) $entry->title),
                'published' => substr((string) $entry->published, 0, 10),
                'thumbnail' => 'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg',
                'url' => 'https://www.youtube.com/watch?v=' . $id,
            ];
            if (count($items) >= 8) {
                break;
            }
        }
    }
}

if ($items !== []) {
    $payload = ['ok' => true, 'source' => 'youtube-rss', 'updated_at' => gmdate('c'), 'items' => $items];
    $encoded = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($encoded !== false) {
        @file_put_contents($cacheFile, $encoded, LOCK_EX);
        echo $encoded;
        exit;
    }
}

// Preserve the last successfully fetched latest-video list if YouTube is
// temporarily unreachable. Never present an empty result while a cache exists.
if (is_file($cacheFile)) {
    $stale = @file_get_contents($cacheFile);
    $decoded = is_string($stale) ? json_decode($stale, true) : null;
    if (is_array($decoded) && ($decoded['ok'] ?? false) === true && !empty($decoded['items'])) {
        header('X-YouTube-Cache: stale');
        echo $stale;
        exit;
    }
}

http_response_code(200);
echo json_encode([
    'ok' => false,
    'source' => 'fallback',
    'message' => 'YouTube RSS is temporarily unavailable. Open the channel for current uploads.',
    'items' => [],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
