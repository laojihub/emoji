<?php
/**
 * 内容中的表情替换
 */
class Emoji
{
    public static $baseUrl = 'http://localhost:8888/img/emoji/';

    public static $dictory = [
        ['id' => 101, 'desc' => '亲亲'],
        ['id' => 102, 'desc' => '小声'],
        ['id' => 103, 'desc' => '酷'],
        ['id' => 104, 'desc' => '恐怖'],
        ['id' => 105, 'desc' => '不开心'],
        ['id' => 106, 'desc' => '吐'],
        ['id' => 107, 'desc' => '调皮'],
        ['id' => 108, 'desc' => '色色'],
        ['id' => 109, 'desc' => '晕'],
        ['id' => 110, 'desc' => '傻笑'],
        ['id' => 111, 'desc' => '哭笑'],
        ['id' => 112, 'desc' => '下'],
        ['id' => 113, 'desc' => '上'],
        ['id' => 114, 'desc' => '赞'],
        ['id' => 115, 'desc' => 'low'],
        ['id' => 116, 'desc' => '右'],
        ['id' => 117, 'desc' => '左'],
        ['id' => 118, 'desc' => '胜利'],
        ['id' => 119, 'desc' => 'OK'],
        ['id' => 120, 'desc' => '再见'],
        ['id' => 121, 'desc' => '鼓掌'],
        ['id' => 122, 'desc' => '加油'],
        ['id' => 123, 'desc' => '彩带'],
        ['id' => 124, 'desc' => '捂脸'],
        ['id' => 125, 'desc' => '心碎'],
        ['id' => 126, 'desc' => '爱心'],
        ['id' => 127, 'desc' => '女医生'],
        ['id' => 128, 'desc' => '男医生'],
        ['id' => 129, 'desc' => '无奈'],
        ['id' => 130, 'desc' => '停止'],
        ['id' => 131, 'desc' => '粑粑'],
        ['id' => 132, 'desc' => '牛逼'],
        ['id' => 133, 'desc' => '救护车'],
        ['id' => 134, 'desc' => '水滴'],
        ['id' => 135, 'desc' => '药'],
        ['id' => 136, 'desc' => '花'],
        ['id' => 137, 'desc' => '蔬菜'],
        ['id' => 138, 'desc' => '水果'],
        ['id' => 139, 'desc' => '吃饭'],
        ['id' => 140, 'desc' => '干杯'],
        ['id' => 141, 'desc' => '鸡腿'],
        ['id' => 142, 'desc' => '无'],
        ['id' => 143, 'desc' => '有'],
        ['id' => 144, 'desc' => '奶瓶'],
        ['id' => 145, 'desc' => '100分'],
        ['id' => 146, 'desc' => '礼物']
    ];

    /**
     * 替换字符串中的表情符号
     */
    public static function replaceStrToEmoji($content)
    {
        $pattern = '/\[.*\]/';

        return  preg_replace_callback($pattern, function ($match) {
            return self::replaceMatchToEmoji($match[0]);
        }, $content);
    }


    public static function replaceMatchToEmoji($str)
    {
        $str = str_replace('[', '', $str);
        $arr = explode(']', $str);

        $img = [];
        foreach ($arr as $tag) {
            if ($tag) {
                $img[] = self::getEmojiImage($tag);
            }
        }

        return implode('', $img);
    }


    /**
     * 翻译表情为图片
     */
    public static function getEmojiImage($name)
    {
        $emoji_id = '';
        foreach (self::$dictory as $face) {
            if ($face['desc'] == $name) {
                $emoji_id = $face['id'];
                break;
            }
        }
        if ($emoji_id) {
            $url = self::$baseUrl . $emoji_id . '.png';
            return "<img title='{$name}' class='emoji' src='{$url}' />";
        }
        return '';
    }


    public static function unicodeDecode($name)
    {
        $str = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $name);
        return $str;
    }

}