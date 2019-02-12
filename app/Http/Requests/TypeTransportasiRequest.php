<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeTransportasiRequest extends FormRequest
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
            'nama_type' => 'alpha_spaces|required|unique:type_transportasi,nama_type'
        ];
    }

    public function messages() {
      return [
        'nama_type.required' => 'Nama tipe transportasi harus diisi!',
        'nama_type.alpha_spaces' => 'Nama tipe transportasi harus berupa huruf dan tanpa tanda baca'
      ];
    }
}
