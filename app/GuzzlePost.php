<?php

namespace App;

/**
 * Class GuzzlePost
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class GuzzlePost extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
