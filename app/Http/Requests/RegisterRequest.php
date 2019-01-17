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
            'username' => 'required|min:3|max:20',
            'password' => 'required',
            'confirm_password' => 'required|confirmed:password',
            'email' => 'required|unique:penumpangs,email',
            'nama_penumpang' => 'required',
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
        'required' => ':attributes harus diisi!',
        'min' => ':attributes harus lebih dari :min karakter',
        'max' => ':attributes harus kurang dari :max karakter',
        'unique' => ':attribute sudah digunakan',
        'confirmed' => ':attribute harus sama'
      ];
    }
}
