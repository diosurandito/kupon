<?php

namespace App\Imports;

use App\Voucher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class VoucherImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Voucher([
            'kode_voucher' => $row['kode_voucher'],
            'nilai' => $row['nilai'],
        ]);
    }
}
