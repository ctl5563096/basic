<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use yii\web\UploadedFile;

/**
 * 相册管理模块
 *
 * Class PhotoController
 * @package app\controllers\backend
 */
class PhotoController extends BaseController
{
    /**
     * 渲染相册模板功能
     *
     * Date: 2020/5/13
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 上传接口
     *
     * Date: 2020/5/13
     * @author chentulin
     * @return string
     */
    public function actionUpload()
    {
        $file = UploadedFile::getInstanceByName('file');
        if (!$file){
            exit(json_encode([
                'code' => 400,
                'msg'  => '上传文件不能为空'
            ]));
        }
        $imageName = date('Y/m/d/').$file->getBaseName();
        $ext = $file->getExtension();
        $rootPath = 'upload/image/';
        var_dump(file_exists($rootPath));die();
        if (!file_exists($rootPath) && !mkdir($rootPath, 0755, true) && !is_dir($rootPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $rootPath));
        }
        $fullName = $rootPath.$imageName.$ext;
        if ($file->saveAs($fullName)){
            exit(json_encode([
                'code' => 200,
                'msg'  => '上传成功'
            ]));
        }
        exit(json_encode([
            'code' => 400,
            'msg'  => '上传文件不能为空'
        ]));
    }
}