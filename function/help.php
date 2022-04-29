<?php

spl_autoload_register(function ($className) {
    require ROOT_PATH . '/' . strtr($className, ['\\' => '/']) . '.php';
});

if (!function_exists('curlCon')) {
    /**
     * 单个 CURL
     * @param $url
     * @param array $postData
     * @param array $header
     * @return bool|string
     */
    function curlCon($url, array $postData = [], array $header = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        //curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_COOKIE, 'ig_pr=1; ig_vw=1364');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate, sdch');
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:' . getClientIp(), 'X-FORWARDED-FOR:' . getClientIp()));

        if (str_starts_with($url, 'https://')) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        }

        if ($header && is_array($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        if ($postData && is_array($postData)) {
            $data = http_build_query($postData);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $con = curl_exec($ch);
        curl_close($ch);
        return $con;
    }
}

if (!function_exists('curlMulti')) {
    /**
     * 多个 CURL
     * @param $urls
     * @param array $postData
     * @param array $header
     * @return array
     */
    function curlMulti($urls, array $postData = [], array $header = [])
    {
        $mh = curl_multi_init();

        $ch  = [];
        $res = [];

        foreach ($urls as $key => $value) {
            $ch[$key] = curl_init($value);

            curl_setopt($ch[$key], CURLOPT_HEADER, 0);
            curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, 1);

            if ($header && is_array($header)) {
                curl_setopt($ch[$key], CURLOPT_HTTPHEADER, $header);
            }

            if ($postData && is_array($postData)) {
                $data = http_build_query($postData);
                curl_setopt($ch[$key], CURLOPT_POST, 1);
                curl_setopt($ch[$key], CURLOPT_POSTFIELDS, $data);
            }

            if (str_starts_with($value, 'https://')) {
                curl_setopt($ch[$key], CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch[$key], CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($ch[$key], CURLOPT_FOLLOWLOCATION, 1);
            }

            curl_multi_add_handle($mh, $ch[$key]);
        }

        $running = null;

        do {
            curl_multi_exec($mh, $running);
            curl_multi_select($mh);
        } while ($running > 0);

        foreach ($ch as $ck => $cv) {
            $res[$ck] = curl_multi_getcontent($cv);
            curl_multi_remove_handle($mh, $cv);
            curl_close($cv);
        }

        curl_multi_close($mh);

        return $res;
    }
}

if (!function_exists('toUnderScore')) {
    /**
     * 驼峰转下划线
     *
     * @param string $camelCaps
     * @param string $separator
     * @return string
     */
    function toUnderScore(string $camelCaps, string $separator = '_'): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }
}

if (!function_exists('toCamelCase')) {
    /**
     * 下划线转驼峰
     *
     * @param string $uncamelized_words
     * @param string $separator
     * @return string
     */
    function toCamelCase(string $uncamelized_words, string $separator = '_'): string
    {
        $uncamelized_words = $separator . str_replace($separator, " ", strtolower($uncamelized_words));
        return ltrim(str_replace(" ", "", ucwords($uncamelized_words)), $separator);
    }
}

if (!function_exists('newInstanceArgs')) {
    function newInstanceArgs($parameters, $reflectionClass)
    {
        foreach ($parameters as $key => $parameter) {
            $injector                      = new ReflectionClass($parameter->getType()->getName());
            $injectorConstructor           = $injector->getConstructor();
            $injectorConstructorParameters = $injectorConstructor->getParameters();

            $parameters[$key] = newInstanceArgs($injectorConstructorParameters, $injector);
        }

        return $reflectionClass->newInstanceArgs($parameters);
    }
}
