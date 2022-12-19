<?php

declare(strict_types=1);
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TextFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('post', [$this, 'limitSize']),
        ];
    }

    public function limitSize(String $str, $limit = 1000, $filters = ['. ','! ','? ']): String
    {
        $sentences = explode( $filters[0], str_replace($filters, $filters[0], $str) );
        $count = 0;
        $end = 1000;
        foreach($sentences as $sentence){
            $count += strlen($sentence)+2;
            if($count > $limit){
                $count -= strlen($sentence)+2;
                $end = $count;
                return substr($str, 0, $end)." ... ";
            }
        }

        return $str;
    }
}