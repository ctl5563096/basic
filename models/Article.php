<?php declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id 文章id
 * @property string $article_name 文章名称
 * @property string $content 文章内容
 * @property int $created_at 创建时间
 * @property int $deleted_at 删除时间
 * @property string $is_delete 是否删除,yes/是,no/否
 * @property int $see_num 观看人数
 * @property string $is_display 是否展示
 * @property int $author 作者
 * @property string $module 文章模块
 * @property string $author_nickname 作者昵称
 * @property string $label 文章标签
 * @property string $introduction 文章简介
 * @property integer $like 点赞数
 * @property integer $hate 踩数
 */
class Article extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'module', 'label', 'author_nickname', 'introduction'], 'string'],
            [['created_at', 'deleted_at', 'see_num', 'author', 'like', 'hate'], 'integer'],
            [['article_name', 'is_delete', 'is_display'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'article_name'    => 'Article Name',
            'content'         => 'Content',
            'created_at'      => 'Created At',
            'deleted_at'      => 'Deleted At',
            'is_delete'       => 'Is Delete',
            'see_num'         => 'See Num',
            'is_display'      => 'Is Display',
            'author'          => 'Author',
            'module'          => '文章模块',
            'author_nickname' => '作者昵称',
            'label'           => '文章标签',
            'introduction'    => '文章简介',
            'like'            => '点赞数',
            'hate'            => '踩数',
        ];
    }
}
