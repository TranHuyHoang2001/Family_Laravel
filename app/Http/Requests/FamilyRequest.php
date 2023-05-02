<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FamilyRequest extends FormRequest
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
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required|unique:families,name',
                ];
            }
            case 'PUT': {
                return [
                    'name' =>['nullable',Rule::unique('families')->ignore($this->id)],
                ];
            }
            case 'PATCH': {
                return [
                    'name' =>['nullable',Rule::unique('families')->ignore($this->id)],
                ];
            }
            default:
                break;
        }
    }
}
