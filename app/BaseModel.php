<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder where($value)
 * @method static \Illuminate\Database\Eloquent\Builder create($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BaseModel extends Model
{

    public static function tableName()
    {
        return ((new static)->getTable());
    }

}
