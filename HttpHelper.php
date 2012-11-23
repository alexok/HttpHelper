<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rick
 * Date: 08.08.12
 * Time: 14:34
 * To change this template use File | Settings | File Templates.
 */
class HttpHelper
{
    public static function loadUrl($url, $post = array(), $options = array())
    {
        // 1. инициализация
        $curl = curl_init();

        // 2. указываем параметры, включая url
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        if ($post) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        if ($options)
            curl_setopt_array($curl, $options);

        // 3. получаем HTML в качестве результата
        $output = curl_exec($curl);

        // 4. закрываем соединение
        curl_close($curl);
        return $output;
    }

    public static function checkUrl($url, $bool = true)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $url);
        curl_setopt($ch, CURLOPT_HEADER,         true);
        curl_setopt($ch, CURLOPT_NOBODY,         true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT,        5);

        $r = curl_exec($ch);

        if ($bool) {
            return strpos($r, '200 OK') !== false ? true : false;
        }

        return $r;
    }
}
