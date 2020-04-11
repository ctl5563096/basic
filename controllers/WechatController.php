<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;

class WechatController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionTest()
    {
        var_dump(111111111111);
    }

    public function actionValid()
    {
        //获取随机字符串
//        $echoStr = input("echostr");
        //获取随机字符串
        $echoStr = Yii::$app->request->get("echostr");

        if ($echoStr) {
            // 验证接口的有效性，由于接口有效性的验证必定会传递echostr 参数
            if ($this->checkSignature()) {
                echo $echoStr;
                exit;
            }
        } else {
            $this->responseMsg();
        }
    }

    protected function checkSignature()
    {
//        $signature = input("signature");
        $signature = Yii::$app->request->get("signature");
//        $timestamp = input("timestamp");//时间戳
        $timestamp = Yii::$app->request->get("timestamp");
//        $nonce = input("nonce");//随机数
        $nonce  = Yii::$app->request->get("nonce");
        $token  = "weixin";  //token值，必须和你设置的一样
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = file_get_contents('php://input');
        Yii::info($postStr);
        Yii::info('测试链接');
        //extract post data
        if (!empty($postStr)) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj      = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername   = $postObj->ToUserName;
            $keyword      = trim($postObj->Content);
            $time         = time();
            $textTpl      = '<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>';
            if (!empty($keyword)) {
                $msgType    = "text";
                $contentStr = "sb!";
                $resultStr  = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "Input something...";
            }
        } else {
            echo "";
            exit;
        }
    }
}
