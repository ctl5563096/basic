<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;

/**
 * 服务器监控控制器
 *
 * Class ServerController
 * @package app\controllers\backend
 */
class ServerController extends BaseController
{
    /**
     * 服务器监控情况
     *
     * Date: 2020/5/19
     * @author chentulin
     */
    public function actionIndex()
    {
        $test = 'ps aux |grep php-fpm'; //ls是linux下的查目录，文件的命令
        exec($test,$array);     //执行命令
        var_dump($array);


//        //CPU占有量
//        $cpu_usage = trim(trim($cpu_info[0],'Cpu(s): '),'%us');  //百分比
//
//        //内存占有量
//        $mem_total = trim(trim($mem_info[0],'Mem: '),'k total');
//        $mem_used = trim($mem_info[1],'k used');
//        $mem_usage = round(100*intval($mem_used)/intval($mem_total),2);  //百分比
//
//
//        $fp = popen('df -lh | grep -E "^(/)"',"r");
//        $rs = fread($fp,1024);
//        pclose($fp);
//        $rs = preg_replace("/\s{2,}/",' ',$rs);  //把多个空格换成 “_”
//        $hd = explode(" ",$rs);
//        $hd_avail = trim($hd[3],'G'); //磁盘可用空间大小 单位G
//        $hd_usage = trim($hd[4],'%'); //挂载点 百分比
//        //print_r($hd);
//
//
//
//        //检测时间
//        $fp = popen("date +"%Y-%m-%d %H:%M"","r");
//        $rs = fread($fp,1024);
//        pclose($fp);
//        $detection_time = trim($rs);
//
//        []
    }
}