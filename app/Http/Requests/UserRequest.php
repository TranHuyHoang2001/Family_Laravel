<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
                    'first_name' => 'required|string|max:255',
                    'password' => 'required|min:8',
                    'password_confirm' => 'required|same:password',
                    'email' => 'required|email|unique:users,email'
                ];
            }
            case 'PUT': {
                return [
                    'first_name' => 'nullable|string|max:255',
                    'password' => 'nullable',
                    'password_confirm' => 'same:password',
                    'email' =>['nullable','email',Rule::unique('users')->ignore($this->id)],
                ];
            }
            case 'PATCH': {
                return [
                    'first_name' => 'nullable|string|max:255',
                    'password' => 'nullable',
                    'password_confirm' => 'same:password',
                    'email' =>['nullable','email',Rule::unique('users')->ignore($this->id)],
                ];
            }
            default:
                break;
        }
    }
}
