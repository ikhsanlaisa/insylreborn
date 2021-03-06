<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Berita extends FormRequest
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
            'id_admin' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg,svg|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'foto.max' => 'Ukuran File terlalu besar'
        ];
    }
}
