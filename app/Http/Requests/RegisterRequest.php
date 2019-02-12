<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'min:3|max:20',
            'password' => 'alpha_spaces|required|min:8',
            'confirm_password' => 'alpha_spaces|required|same:password',
            'email' => 'alpha_spaces|email|required|unique:penumpangs,email',
            'nama_penumpang' => 'alpha_spaces|required',
        ];
    }

    public function attributes() {
      return [
        'username' => 'Nama pengguna',
        'password' => 'Kata sandi',
        'confirm_password' => 'Konfirmasi kata sandi',
        'email' => 'Alamat email',
        'nama_penumpang' => 'Nama lengkap'
      ];
    }

    public function messages() {
      return [
        'required' => ':attribute harus diisi!',
        'min' => ':attribute harus lebih dari :min karakter',
        'max' => ':attribute harus kurang dari :max karakter',
        'unique' => ':attribute sudah digunakan',
        'same' => ':attribute harus sama',
        'alpha_spaces' => ':attribute harus berupa huruf dan tanpa tanda baca',
        'email' => 'Format email salah'
      ];
    }
}
