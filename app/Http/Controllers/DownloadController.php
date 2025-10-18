<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EntriesExport;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        $entries = Entry::where('cell', $request->cell)
                        ->where('entry_date', $request->date)
                        ->with('masterItem')
                        ->get();

        return Excel::download(new EntriesExport($entries), 'stock_opname.xlsx');
    }
}
