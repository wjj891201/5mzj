<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use DOMDocument;

class GoodsController extends ActiveController
{

    public $modelClass = 'api\models\Goods';

    # 写入xml
//    public function actionWriteXml()
//    {
//        $save_path = $_SERVER['DOCUMENT_ROOT'] . '\\xml\\';
//        if (!file_exists($save_path))
//        {
//            mkdir($save_path);
//        }
//        var_dump($save_path);
//        exit;
//        $this->CreateXml(2, 3, 4, 5, 6, 7);
//        echo 123;
//        exit;
//    }
    # 读取xml文件
//    public function actionXml()
//    {
//        $xml = simplexml_load_file('log.xml');
//        $xml = json_encode($xml);
//        $xml = json_decode($xml, true);
//        var_dump($xml['article']);
//        exit;
//    }
//    public function CreateXml($title_value, $tags, $author_value, $body_value, $time_value, $view_num)
//    {
//        $xmlpath = "log.xml";
//        $dom = new DomDocument('1.0', 'utf-8');
//        $dom->formatOutput = true;
//        // $dom->load($xmlpath);
//        // $tag = $dom->getElementsByTagName("title");
//        if (file_exists($xmlpath))
//        {
//            # 如果文件存在，则进行追加
//
//            $dom->formatOutput = true;
//            $dom->load($xmlpath);
//            $newarticles = $dom->createElement('article');
//            $articles = $dom->getElementsByTagName("page")->item(0);  //找到文件追加的位置
//            $articles->appendChild($newarticles);    //进行文件追加
//
//            $title = $dom->createElement('title');
//            $title->appendChild($dom->createTextNode($title_value));
//            $newarticles->appendChild($title);
//
//            $author = $dom->createElement('author');
//            $author->appendChild($dom->createTextNode($author_value));
//            $newarticles->appendChild($author);
//
//            $body = $dom->createElement('body');
//            $body->appendChild($dom->createTextNode($body_value));
//            $newarticles->appendChild($body);
//
//            $tag = $dom->createElement('tag');
//            $tag->appendChild($dom->createTextNode($tags));
//            $newarticles->appendChild($tag);
//
//            $time = $dom->createElement('time');
//            $time->appendChild($dom->createTextNode($time_value));
//            $newarticles->appendChild($time);
//
//            $view = $dom->createElement('view');
//            $view->appendChild($dom->createTextNode($view_num));
//            $newarticles->appendChild($view);
//
//            $dom->save($xmlpath);
//        }
//        else
//        {
//            #如果文件不存在，则进行文件写入
//            //$dom = new DomDocument('1.0','utf-8');
//            $dom->formatOutput = true;
//
//
//            $page = $dom->createElement('page');
//            $dom->appendChild($page);
//
//            $articles = $dom->createElement('article');
//            $page->appendChild($articles);
//
//            $title = $dom->createElement('title');
//            $title->appendChild($dom->createTextNode($title_value));
//            $articles->appendChild($title);
//
//            $author = $dom->createElement('author');
//            $author->appendChild($dom->createTextNode($author_value));
//            $articles->appendChild($author);
//
//            $body = $dom->createElement('body');
//            $body->appendChild($dom->createTextNode($body_value));
//            $articles->appendChild($body);
//
//            $tag = $dom->createElement('tag');
//            $tag->appendChild($dom->createTextNode($tags));
//            $articles->appendChild($tag);
//
//            $time = $dom->createElement('time');
//            $time->appendChild($dom->createTextNode($time_value));
//            $articles->appendChild($time);
//
//            $view = $dom->createElement('view');
//            $view->appendChild($dom->createTextNode($view_num));
//            $articles->appendChild($view);
//
//            $dom->save($xmlpath);
//        }
//    }

    public function actionAddLog()
    {
        # 创建目录
        $save_path = $_SERVER['DOCUMENT_ROOT'] . '/sidiw_log/' . date('Ym') . '/';
        if (!file_exists($save_path))
        {
            mkdir($save_path);
        }
        $data = [1, 2, 3, 4, 5, 6];
        $this->Createlog($data, $save_path);
        return ['日志添加成功'];
    }

    public function Createlog($data, $save_path)
    {
        $final_url = $save_path . date('d') . '.log';
        $str = implode(",", $data);
        $file = fopen($final_url, "a");
        fwrite($file, $str . "\n");
        fwrite($file, "----------\n");
    }

}
