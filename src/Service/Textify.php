<?php

namespace App\Service;

final class Textify
{
    public static function trim(string $text, int $limit): string
    {
        if (strlen($text) <= $limit) {
            return $text;
        }

        $text = substr($text, 0, $limit);
        $lastDot = strrpos($text, '.');

        if ($lastDot !== false) {
            return substr($text, 0, $lastDot) . '...';
        }

        $lastSpace = strrpos($text, ' ');

        if ($lastSpace !== false) {
            return substr($text, 0, $lastSpace) . '...';
        }

        return $text . '...';
    }
}
