<?php declare(strict_types=1);


namespace app\dto;

/**
 * 评论dto
 *
 * Class CommentDto
 * @package app\dto
 * @property string $comment
 * @property string $ip
 * @property int $article_id
 */
class CommentDto extends BaseDto
{
    /** @var string $content */
    public $comment;

    /** @var string $ip */
    public $ip;

    /** @var int $article_id */
    public $article_id;

    public function rules()
    {
        return [
            [['ip','article_id','comment'],'required'],
        ];
    }

}