<?php
use Carbon\Carbon;
// use Parsedown;

if (!function_exists('timeAgo')) {
    function timeAgo($date)
    {
        return Carbon::parse($date)->ago();
    }
}

if (!function_exists('markdown_to_html')) {
    function markdown_to_html($markdown)
    {
        $parsedown = new Parsedown();
        return $parsedown->text($markdown);
    }
}

?>