<?php

namespace App\Exports;

use App\Models\Entry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntriesExport implements FromCollection, WithHeadings
{
    protected $entries;

    public function __construct($entries)
    {
        $this->entries = $entries;
    }

    /**
     * Return the collection of entries to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->entries;
    }

    /**
     * Define the headings for the Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Locator',
            'Item Code',
            'Lot Number',
            'Tag No',
            'Qty Bagus',
            'Qty Pecah',
            'Inv Tag',
            'Note'
        ];
    }
}
