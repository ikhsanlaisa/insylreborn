<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'id_kelas' => $this['id_kelas'],
            'id_user' => $this['id_user'],
            'nit' => $this['nit'],
            'nama' => $this['nama'],
            'gender' => $this['gender'],
            'kontak' => $this['kontak'],
            'alamat' => $this['alamat'],
            'tanggal_lahir' => $this['tanggal_lahir']
        ];
    }
}
