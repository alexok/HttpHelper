<?php
/**
 * User: Alexok
 * Date: 08.08.12
 * Time: 14:34
 */
class HttpHelper
{
    public static function loadUrl($url, $post = array(), $options = array())
    {
        // 1. Init
        $curl = curl_init();

        // 2. Set params, included URL
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT,        5);

        if ($post) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        if ($options)
            curl_setopt_array($curl, $options);

        // 3. Get HTML-response
        $output = curl_exec($curl);

        // 4. Close connection
        curl_close($curl);
        return $output;
    }

    public static function checkUrl($url, $bool = true)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL,            $url);
        curl_setopt($curl, CURLOPT_HEADER,         true);
        curl_setopt($curl, CURLOPT_NOBODY,         true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT,        5);

        $r = curl_exec($curl);

        if ($bool) {
            return strpos($r, '200 OK') !== false ? true : false;
        }

        return $r;
    }
}