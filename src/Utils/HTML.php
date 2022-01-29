<?php

namespace Tiptap\Utils;

class HTML
{
    public static function mergeAttributes(array $attributes, array $moreAttributes)
    {
        foreach ($moreAttributes as $key => $value) {
            // class="foo bar"
            if ($key === 'class') {
                $attributes['class'] = trim($attributes['class'] ?? '' . ' ' . $value);

                continue;
            }

            // style="color: red;"
            if ($key === 'style') {
                $style = rtrim($attributes['style'] ?? '', '; ') . '; ' . rtrim($value, ';') . '; ';
                $attributes['style'] = ltrim(trim($style), '; ');

                continue;
            }

            $attributes[$key] = $value;
        }

        return $attributes;
    }

    public static function renderAttributes(array $attrs)
    {
        $attributes = [];

        foreach (array_filter($attrs) ?? [] as $name => $value) {
            $attributes[] = " {$name}=\"{$value}\"";
        }

        return join($attributes);
    }
}
