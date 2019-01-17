<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuteRequest extends FormRequest
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
            'tujuan' => 'required',
            'rute_awal' => 'required',
            'rute_akhir' => 'required',
            'harga' => 'required',
            'id_transportasi' => 'required',
            'id_type_rute' => 'required'
        ];
    }

    public function messages() {
      return [
        'tujuan.required' => 'Tujuan harus diisi!',
        'rute_awal.required' => 'Rute awal harus diisi!',
        'rute_akhir.required' => 'Rute akhir harus diisi!',
        'harga.required' => 'Harga harus diissi!',
        'id_transportasi.required' => 'Transportasi harus diisi!',
        'id_type_rute.required' => 'Tipe rute harus diisi!'
      ];
    }
}
