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
            'email' => 'alpha_spaces|required|email|unique:penumpangs,email,' . auth()->guard('penumpang')->user()->id_penumpang . ',id_penumpang',
            'nama_penumpang' => 'alpha_spaces|required'
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
        'required' => ':attribute harus diisi',
        'min' => ':attribute harus lebih dari :min',
        'max' => ':attribute harus kurang dari :max',
        'unique' => ':attribute sudah digunakan',
        'email' => 'Format email tidak valid',
        'alpha_spaces' => ':attribute harus berupa huruf dan tanpa tanda baca'
      ];
    }
}
