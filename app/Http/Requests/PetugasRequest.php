<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetugasRequest extends FormRequest
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
            'username' => 'required|min:5|max:20',
            'password' => 'required',
            'email' => 'required|email|unique:petugass,email',
            'nama_petugas' => 'required|unique:petugass,nama_petugas',
            'jenis_kelamin' => 'required',
            'id_level' => 'required'
        ];
    }

    public function attributes() {
      return [
        'username' => 'Nama pengguna',
        'password' => 'Kata sandi',
        'email' => 'Email',
        'nama_petugas' => 'Nama lengkap',
        'jenis_kelamin' => 'Jenis kelamin',
        'id_level' => 'Level'
      ];
    }

    public function messages() {
      return [
        'required' => ':attributes harus diisi!',
        'min' => ':attributes harus lebih dari :min',
        'max' => ':attributes harus kurang dari :max',
        'unique' => ':attributes sudah digunakan'
      ];
    }
}
