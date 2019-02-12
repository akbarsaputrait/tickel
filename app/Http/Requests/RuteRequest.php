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
            'tujuan' => 'alpha_spaces|required',
            'rute_awal' => 'alpha_spaces|required',
            'rute_akhir' => 'alpha_spaces|required',
            'harga' => 'numeric|required',
            'id_transportasi' => 'required',
            'id_type_rute' => 'required',
            'jam_berangkat' => 'required',
            'jam_tiba' => 'required'
        ];
    }

    public function attributes() {
      return [
        'tujuan' => 'Tujuan',
        'rute_awal' => 'Rute awal',
        'rute_akhir' => 'Rute akhir',
        'harga' => 'Harga',
        'id_transportasi' => 'Transportasi',
        'id_type_rute' => 'Kelas',
        'jam_berangkat' => 'Jam berangkat',
        'jam_tiba' => 'Jam tiba'
      ];
    }

    public function messages() {
      return [
        'required' => ':attribute harus diisi!',
        'alpha_spaces' => ':attribute harus berupa huruf dan tanpa tanda baca',
      ];
    }
}
