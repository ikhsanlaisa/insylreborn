<?php

namespace App\Http\Requests;

use App\Models\User;
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
            'username' => 'required|regex:/^[a-z]+$/|unique:users,username',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5',
            'id_tipe' => 'required|exists:tipe_admin,id',
            'id_layanan' => 'exists:layanan_pengaduan,id',
            'nip' => 'required|string',
            'nama' => 'required|string',
        ];

    }
}
