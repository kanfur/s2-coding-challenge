<?php

namespace App\Twig;

use App\Service\Textify;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TextifyExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('textify', [$this, 'textify']),
        ];
    }

    public function textify(string $text, int $limit = 1000): string
    {
       return Textify::trim($text, $limit);
    }
}