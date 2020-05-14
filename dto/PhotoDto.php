<?php declare(strict_types=1);

namespace app\dto;

/**
 * Class PhotoDto
 * @package app\dto
 * @property string $url
 * @property string $content
 * @property string $type
 */
class PhotoDto extends BaseDto
{
    /** @var string $url */
    public $url;

    /** @var string $content */
    public $content;

    /** @var string $type */
    public $type;

    public function rules()
    {
        return [
            [['url', 'content', 'type'], 'required'],
        ];
    }
}