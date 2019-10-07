<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password_confirmed' => 'sometimes|same:password',
            'profile.first_name' => 'max:255',
            'profile.last_name' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'password_confirmed.same' => 'Password did not match.',
        ];
    }
}
