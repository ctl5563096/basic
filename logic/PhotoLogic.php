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
    public function getDayPhoto(array $list, int $page): array
    {
        $time = [];
        $data = [];
        // 构建时间区间
        for ($i = 0; $i < 5; $i++) {
            $end                                       = (strtotime(date('Y-m-d')) + 86400 - 1) - $page * 86400 * $i;
            $start                                     = $end - 86399;
            $time[date('Y-m-d', (int)$start)]['start'] = $start;
            $time[date('Y-m-d', (int)$start)]['end']   = $end;
        }

        // 两重foreach循环炸穿
        foreach ($list as $key => $value) {
            foreach ($time as $k => $v) {
                if ($value['upload_time'] > $v['start'] && $value['upload_time'] < $v['end']) {
                    $data[$k][] = $value;
                }
            }
        }
        return array_reverse($data);
    }
}