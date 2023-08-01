<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'nullable',
            'nama' => 'required',
            'biaya_id' => 'required|exists:biayas,id',
            'nohp' => 'required',
            'desa' => 'required', 
            'kecamatan' => 'required', 
            'alamat_lengkap' => 'required', 
            'paket' => 'nullable|exists:biayas,id', 
        ];
    }
}
