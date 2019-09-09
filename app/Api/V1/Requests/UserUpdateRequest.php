<?php

namespace App\Api\V1\Requests;

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
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
            'first_name' => 'sometimes|required|max:255',
            'last_name' => 'sometimes|required|max:255',
        ];
    }
}
