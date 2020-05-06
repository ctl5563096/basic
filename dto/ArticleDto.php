<?php declare(strict_types=1);


namespace app\dto;

use yii\base\Model;

/**
 * 文章数据验证层
 *
 * Class ArticleDto
 * @package app\dto
 * @property string $article_name 文章名
 * @property string $content 文章内容
 * @property string $author_nickname 作者昵称
 * @property string $label 文章标签
 * @property string $module 文章所属模块
 * @property string $is_display 是否展示
 * @property string $introduction 文章简介
 */
class ArticleDto extends BaseDto
{
    public const SCENARIO_CREATE = 'create';

    public const SCENARIO_UPDATE = 'update';

    /** @var string $article_name */
    public $article_name;

    /** @var string $content */
    public $content;

    /** @var string $author_nickname*/
    public $author_nickname;

    /** @var string $label */
    public $label;

    /** @var string $module */
    public $module;

    /** @var string $is_display */
    public $is_display;

    /** @var string $introduction */
    public $introduction;

    public function rules()
    {
        return [
            [['author_nickname','module','content','article_name','is_display','introduction'],'required','on' => self::SCENARIO_CREATE],
            [['label'],'safe','on' => self::SCENARIO_CREATE],
            [['author_nickname','module','content','article_name','is_display','introduction'],'required','on' => self::SCENARIO_UPDATE],
            [['label'],'safe','on' => self::SCENARIO_UPDATE],
        ];
    }
}