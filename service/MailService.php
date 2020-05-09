<?php declare(strict_types=1);


namespace app\service;

use Yii;

/**
 * 发邮件题目
 *
 * Class MailService
 * @package app\service
 */
class MailService
{
    /**
     *  执行发邮件
     *
     * Date: 2020/5/9
     * @param string $content
     * @return bool
     * @author chentulin
     */
    public function sendMail(string $content): bool
    {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('chentulinys@163.com');              //要发送给那个人的邮箱
        $mail->setSubject('有人在博客给你留言了');                //邮件主题
        $mail->setTextBody($content);                           //发布纯文字文本
        return $mail->send();
    }
}