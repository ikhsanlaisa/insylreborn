<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pengaduan extends FormRequest
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
            'id_siswa' => 'required|exists:siswa,id',
            'id_jenis' => 'required|exists:layanan_pengaduan,id',
            'isi' => 'required',
            'link_foto' => 'image|mimes:png,jpg,jpeg,svg|max:5000'
        ];
    }
}
