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
            'rute_awal' => 'alpha_spaces|required',
            'rute_akhir' => 'alpha_spaces|required',
            'tanggal_berangkat' => 'date|required',
            'jam_berangkat' => 'required',
            'transportasi' => 'alpha_spaces|required',
            'kelas' => 'alpha_spaces|required'
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
        'required' => ':attribute harus diisi!',
        'alpha_spaces' => ':attribute harus berupa huruf dan tanpa tanda baca',
        'date' => ':attribute memiliki format yang salah'
      ];
    }
}
