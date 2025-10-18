<?php

namespace App\Imports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterItemImport implements ToModel, WithHeadingRow
{
    /*
     * Transform the row data into a MasterItem model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MasterItem([
            'item_code'   => $row['item_code'],
            'item_name'   => $row['item_name'],
            'primary_uom' => $row['primary_uom'],
            'lot_number'  => $row['lot_number'], // Bisa memiliki lebih dari satu lot_number untuk item_code yang sama
        ]);
    }
    public function chunkSize(): int
    {
        return 1000;  // Ukuran chunk (jumlah baris per batch)
    }
}
