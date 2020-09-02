<?php

namespace App\Http\Requests\API;

use App\Models\Posts;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use InfyOm\Generator\Request\APIRequest;

class PostsAPIRequest extends APIRequest
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
        switch ($this->method()){
            case 'POST':
                return Posts::$rules;
            break;
            case 'PUT':
                return Posts::$rules_update;
            break;
            default:
                return [];
            break;
        }
    }
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'failure',
            'status_code' => 400,
            'message' => 'Bad Request',
            'errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 400));
    }

    public function messages()
    {
        return [
            'required' => ':attribute Không được để trống',
            'max' => ':attribute Không được quá :max ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tieu de',
            'body' => 'Noi dung'
        ];
    }
}
