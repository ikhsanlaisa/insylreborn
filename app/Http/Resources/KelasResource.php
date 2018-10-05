<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KelasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'id_subdiklat' => $this['id_subdiklat'],
            'kode' => $this['kode'],
            'nama' => $this['nama'],
            'angkatan' => $this['angkatan'],
            'subdiklat' => $this['angkatan']['subdiklat']
        ];
    }
}
