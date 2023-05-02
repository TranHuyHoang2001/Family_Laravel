<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CriteriaRequest extends FormRequest
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
                    'name' => 'required|unique:criterias,name',
                    'proviso' => 'required',
                ];
            }
            case 'PUT': {
                return [
                    'name' =>['nullable',Rule::unique('criterias')->ignore($this->id)],
                    'proviso' => 'required',
                ];
            }
            case 'PATCH': {
                return [
                    'name' =>['nullable',Rule::unique('criterias')->ignore($this->id)],
                    'proviso' => 'required',
                ];
            }
            default:
                break;
        }
    }
}
