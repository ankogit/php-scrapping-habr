<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'vendor/autoload.php';
require 'helpers.php';

$client = new \Goutte\Client();

function generateData($crawler, &$data)
{
    $crawler->filter('article')->each(function ($node) use (&$data) {
        $element = [];

        //Автор
        $node->filter('div.tm-article-snippet > div.tm-article-snippet__meta-container > div > span.tm-user-info.tm-article-snippet__author > span > a')->each(function ($nested_node) use (&$element) {
            $element['author'] = $nested_node->text();
        });

        //Название
        $node->filter('div.tm-article-snippet > h2 > a > span')->each(function ($nested_node) use (&$element) {
            $element['title'] = $nested_node->text();
        });

        //Описание
        $node->filter('div.tm-article-snippet > div.tm-article-body.tm-article-snippet__lead > div:nth-child(2) > div:nth-child(1) > div')->each(function ($nested_node) use (&$element) {
            $element['description'] = $nested_node->text();
        });

        $data[] = $element;

    });
}

$data = [];




$crawlerP1 = $client->request('GET', 'https://habr.com/ru/flows/develop/');
$crawlerP2 = $client->request('GET', 'https://habr.com/ru/flows/develop/page2/');


generateData($crawlerP1, $data);
generateData($crawlerP2, $data);


dd(count($data), json_encode($data));

//Скопировать строку в json парсер чтобы получить результат  http://json.parser.online.fr/

