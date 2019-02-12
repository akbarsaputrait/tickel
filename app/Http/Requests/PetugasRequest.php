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
            'password' => 'alpha_spaces|required',
            'email' => 'alpha_spaces|required|email|unique:petugass,email,6,id_petugas',
            'nama_petugas' => 'alpha_spaces|required|unique:petugass,nama_petugas,6,id_petugas',
            'jenis_kelamin' => 'alpha_spaces|required',
            'id_level' => 'alpha_spaces|required',
            'image' => 'file|mimes:jpeg,jpg,png|max:2000|dimensions:min_width=400,min_height=600'
        ];
    }

    public function attributes() {
      return [
        'username' => 'Nama pengguna',
        'password' => 'Kata sandi',
        'email' => 'Email',
        'nama_petugas' => 'Nama lengkap',
        'jenis_kelamin' => 'Jenis kelamin',
        'id_level' => 'Level',
        'image' => 'Gambar'
      ];
    }

    public function messages() {
      return [
        'required' => ':attribute harus diisi!',
        'min' => ':attribute harus lebih dari :min',
        'max' => ':attribute harus kurang dari :max',
        'unique' => ':attribute sudah digunakan',
        'mimes' => ':attribute harus berupa file :mimes',
        'min_width' => 'Ukuran :attribute harus kurang dari :min_width px dan :min_height px',
        'file' => 'Gambar tidak dapat diunggah',
        'alpha_spaces' => ':attribute harus berupa huruf dan tanpa tanda baca'
      ];
    }
}
