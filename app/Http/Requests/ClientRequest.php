<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|unique:clients,email'
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required',
                    'lastname' => 'required',
                    'email' => ['required','email',Rule::unique('clients')->ignore($this->id)]
                ];
            }
        }
    }
}
