<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MemberImport implements ToModel, WithStartRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }
        return new Member([
            'nama' => $row[1],
            'nohp' => $row[2],
            'desa' => $row[3],
            'alamat_lengkap' => $row[4],
            'idpel' => $row[5],
            'biaya_id' => $row[6],
        ]);
    }

    /**
     * @return int
    */
    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|uniquie:members,nama',
            'nohp' => 'required',
            'desa' => 'required',
            'alamat_lengkap' => 'required',
            'idpel' => 'required|uniquie:members,idpel',
            'biaya_id' => 'required|exists:biayas,id',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'nama.unique' => 'Data :attribute tidak boleh sama',
            'idpel.unique' => 'Data :attribute tidak boleh sama',
            'idpel.required' => 'Data :attribute wajib diisi',
            'nohp.required' => 'Data :attribute wajib diisi',
            'desa.required' => 'Data :attribute wajib diisi',
            'alamat_lengkap.required' => 'Data :attribute wajib diisi',
            'biaya_id.exists' => 'Data :attribute tidak ditemukan',
        ];
    }
}
