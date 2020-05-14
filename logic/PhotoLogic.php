<?php declare(strict_types=1);

namespace app\logic;

/**
 * 相册逻辑处理层
 *
 * Class PhotoLogic
 * @package app\logic
 */
class PhotoLogic
{
    /**
     * Notes: 获取每天的照片
     * @param array $list
     * @param int $page
     * @return array
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 11:20
     */
    public function getDayPhoto(array $list ,int $page): array
    {
        $endTime   = strtotime(date("Y-m-d", time())) + 86400 * $page - 1 ;
         var_dump($list);die();
    }
}