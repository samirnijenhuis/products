<?php

namespace Snijenhuis\Modules\Auth\Http\Requests;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required'
        ];
    }
}
