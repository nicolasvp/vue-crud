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
                    'name' => 'required|max: 50',
                    'lastname' => 'required|max: 50',
                    'email' => 'required|max:50|email|unique:clients,email',
                    'image' => 'nullable|image|max:1000'
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|max: 50',
                    'lastname' => 'required|max: 50',
                    'email' => ['required','max:50','email',Rule::unique('clients')->ignore($this->id)],
                    'image' => 'nullable|image|max:1000'
                ];
            }
        }
    }
}
