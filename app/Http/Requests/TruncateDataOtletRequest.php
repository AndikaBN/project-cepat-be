<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruncateDataOtletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //create request
            'stat' => 'required',
            'bebas_blok' => 'required',
            'kode' => 'required',
            'nama_customer' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'daerah' => 'required',
            'area' => 'required',
            'telp' => 'required',
            'keterangan' => 'required',
            'ktp' => 'required',
            'npwp' => 'required',
            'gol' => 'required',
            'tgl_input' => 'required',
            'set_harga' => 'required',
            'area_antaran' => 'required',
            'area_tagihan' => 'required',
            'type_customer' => 'required',
            'limit_kredit' => 'required',
            'limit_divisi' => 'required',
            'nama_npwp' => 'required',
            'alamat_npwp' => 'required',
        ];
    }
}
