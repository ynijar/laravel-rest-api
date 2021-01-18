<?php

namespace App;

/**
 * Class Post
 * @package App
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read User $user
 */
class Post extends BaseModel
{
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
