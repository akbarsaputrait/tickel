<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenumpangRequest extends FormRequest
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
            'username' => 'required|min:8|max:20|unique:penumpangs,username,' . auth()->guard('penumpang')->user()->id_penumpang . ',id_penumpang',
            'email' => 'required|email|unique:penumpangs,email,' . auth()->guard('penumpang')->user()->id_penumpang . ',id_penumpang',
            'nama_penumpang' => 'required'
        ];
    }

    public function attributes() {
      return [
        'username' => 'Nama pengguna',
        'email' => 'Alamat email',
        'nama_penumpang' => 'Nama lengkap'
      ];
    }

    public function messages() {
      return [
        'required' => ':attributes harus diisi',
        'min' => ':attributes harus lebih dari :min',
        'max' => ':attributes harus kurang dari :max',
        'unique' => ':attributes sudah digunakan',
        'email' => 'Format email tidak valid'
      ];
    }
}
