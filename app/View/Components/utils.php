<?php
function truncateText($text, $length = 100, $suffix = '...') {
    $text = strip_tags($text);
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    $truncated = mb_substr($text, 0, $length);
    $lastSpace = mb_strrpos($truncated, ' ');
    if ($lastSpace !== false) {
        $truncated = mb_substr($truncated, 0, $lastSpace);
    }
    return $truncated . $suffix;
}