<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesanTiketRequest extends FormRequest
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
            'rute_awal' => 'required',
            'rute_akhir' => 'required',
            'tanggal_berangkat' => 'required',
            'jam_berangkat' => 'required',
            'transportasi' => 'required',
            'kelas' => 'required'
        ];
    }

    public function attributes() {
      return [
        'rute_awal' => 'Kota asal',
        'rute_akhir' => 'Kota tujuan',
        'tanggal_berangkat' => 'Tanggal berangkat',
        'jam_berangkat' => 'Jam berangkat',
        'transportasi' => 'Transportasi',
        'kelas' => 'Kelas'
      ];
    }

    public function messages() {
      return [
        'required' => ':attributes harus diisi!'
      ];
    }
}
