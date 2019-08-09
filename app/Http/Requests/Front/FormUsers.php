<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class FormUsers extends FormRequest
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
        $id = $this->segment(3);
        return [
            'name'      => "required|min:3|max:100",
            'email'     => "required|min:6|max:100|email|unique:users,email,{$id},id",
            'cnpj'     => "required|min:17|max:18",
            'type'      => "required|in:debtor,creditor",
            'password'  => 'max:16|confirmed',
        ];
    }
}
