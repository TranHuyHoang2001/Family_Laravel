<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'description' => 'nullable|max:255',
                    'price' => 'numeric|nullable',
                    'image' => 'required|image',
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|max:255',
                    'description' => 'nullable|max:255',
                    'price' => 'numeric|nullable',
                    'image' => 'nullable|image',
                ];
            }
            case 'PATCH':
            {
                return [];
            }
            default:
                break;
        }
    }
}
