<?php

namespace App\Http\Requests;

/**
 * Class PostRequest
 * @package App\Http\Requests
 *
 * @property string $name
 * @property string $description
 */
class PostRequest extends Request
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
        return [
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
