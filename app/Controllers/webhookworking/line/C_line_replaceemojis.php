<?php

namespace App\Controllers\webhook\line;

class C_line_replaceemojis 
{
    function replaceEmojis_array($text, $emojis)
    {
        $result = $text;
        foreach ($emojis as $productId => $emoji) {
            foreach($emoji as $v){
                $emojiId     = $v['emojiId'];
                $text_emoji  = $v['text_emoji'];
                $replacement = '<img src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/' . $productId . '/android/' . $emojiId . '.png?v=1" class="line-emoji">';
                $result      = str_replace($text_emoji, $replacement, $result);
            }
        }
        return $result;
    }

    function replaceEmojis($text, $emojis)
    {
        $result = $text;
        $offset = 0;
        foreach ($emojis as $emoji) {
            $start       =  $emoji['index'] + $offset;
            $length      =  $emoji['length'];
            $emojiId     =  $emoji['emojiId'];
            $productId   =  $emoji['productId'];
            $replacement =  '<img src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/' . $productId . '/android/' . $emojiId . '.png?v=1" class="line-emoji">';
            $result      =  $this->mb_substr_replace($result, $replacement, $start, $length);
            $offset      += mb_strlen($replacement, 'utf-8') - $length;
        }
        return $result;
    }

    function mb_substr_replace($original, $replacement, $position, $length)
    {
        $startString = mb_substr($original, 0, $position, 'utf-8');
        $endString   = mb_substr($original, $position + $length, mb_strlen($original, 'utf-8'), 'utf-8');
        $result      = $startString . $replacement . $endString;
        return $result;
    }
}
