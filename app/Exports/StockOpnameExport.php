<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StockOpnameExport implements FromCollection, WithHeadings, WithMapping
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    // Mendapatkan data yang sudah difilter
    public function collection()
    {
        return $this->transactions;
    }

    // Menambahkan heading ke file excel
    public function headings(): array
    {
        return [
            'no',
            'locator',
            'item_code',
            'lot_number',
            'tag_no',
            'qty_bagus',
            'qty_pecah',
            'inv_tag',
            'note',
        ];
    }

    // Menyusun data setiap baris berdasarkan header
    public function map($transaction): array
    {
        // Mengambil item_code berdasarkan item_name
        $item = \App\Models\MasterItem::where('item_name', $transaction->item_name)->first();

        return [
            $transaction->id, // no
            $transaction->cell, // locator
            $item ? $item->item_code : '', // item_code
            $transaction->tonality, // lot_number
            $transaction->tag_no, // tag_no
            $transaction->qty_utuh, // qty_bagus
            $transaction->qty_pecah, // qty_pecah
            $transaction->inv_tag, // inv_tag
            $transaction->note, // note
        ];
    }
}
