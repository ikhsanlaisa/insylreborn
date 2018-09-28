<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Admin extends FormRequest
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
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
            'id_tipe' => 'required|exists:tipe_admin,id',
            'id_layanan' => 'exists:layanan_pengaduan,id',
            'nip' => 'required|string',
            'nama' => 'required|string',
        ];
    }
}
