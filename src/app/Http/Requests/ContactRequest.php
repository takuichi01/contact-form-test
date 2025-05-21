<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'last_name'   => ['required', 'string', 'max:255'],
            'first_name'  => ['required', 'string', 'max:255'],
            'gender'      => ['required', 'in:1,2,3'],
            'email'       => ['required', 'email'],
            'first_tel'   => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'second_tel'  => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'third_tel'   => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'address'     => ['required', 'string', 'max:255'],
            'building'    => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'detail'      => ['required', 'string', 'max:120'],
        ];
    }

    public function messages() 
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'first_tel.required'   => '電話番号を入力してください',
            'second_tel.required'  => '電話番号を入力してください',
            'third_tel.required'   => '電話番号を入力してください',
            'first_tel.regex:/^[0-9]+$/'   => '電話番号は5桁までの数字で入力してください',
            'second_tel.regex:/^[0-9]+$/'  => '電話番号は5桁までの数字で入力してください',
            'third_tel.regex:/^[0-9]+$/'   => '電話番号は5桁までの数字で入力してください',
            'first_tel.max:5'   => '電話番号は5桁までの数字で入力してください',
            'second_tel.max:5'  => '電話番号は5桁までの数字で入力してください',
            'third_tel.max:5'   => '電話番号は5桁までの数字で入力してください',
            'address.required'     => '住所を入力してください',
            'building.required'    => '建物名を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max:120'       => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
