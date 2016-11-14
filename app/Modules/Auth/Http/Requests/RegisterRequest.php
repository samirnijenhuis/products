<?php

namespace Snijenhuis\Modules\Auth\Http\Requests;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Sentinel $sentinel
     * @return bool
     */
    public function authorize(Sentinel $sentinel)
    {
        return $sentinel->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
