<?php

namespace App\Http\Requests;

use App\Reference\Constants;

/**
 * Class PostSearchRequest
 * @package App\Http\Requests
 *
 * @property string $search
 * @property int $limit
 * @property int $offset
 */
class PostSearchRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!$this->limit) {
            $this->limit = Constants::DEFAULT_LIMIT;
            $this->offset = Constants::DEFAULT_OFFSET;
        }

        return [
            'limit' => 'nullable|integer',
            'offset' => 'nullable|integer',
            'search' => 'nullable|string',
        ];
    }
}
