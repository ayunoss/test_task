<?php

$url = "https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3";
$value = "3";
$newParam = '/test/index.html';

function task2($url, $value, $newParam) {
    $parsedUrl = parse_url($url);
    parse_str($parsedUrl['query'], $params);
    $sortParams = array_filter($params, function ($paramValue) use ($value) {
        return $paramValue !== (string)$value;
    });
    asort($sortParams);
    $newParams = [];
    foreach ($sortParams as $key => $val) {
        $newParams[$key] = $val;
    }
    $newParams['url'] = $newParam;

    return generateUrl($parsedUrl['host'], '', $newParams, $parsedUrl['scheme']);
}

function generateUrl($host, $path, $params = [], $scheme = 'https')
{
    return $scheme . '://' . $host . '/' . $path . '?' . http_build_query($params);
}

echo task2($url, $value, $newParam);