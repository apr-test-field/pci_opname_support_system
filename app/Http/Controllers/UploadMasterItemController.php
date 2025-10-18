<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MasterItemImport;

class UploadMasterItemController extends Controller
{
    // Menampilkan halaman form upload master item
    public function index()
    {
        return view('upload_master_item');
    }

    // Menghandle upload file dan import data
    public function upload(Request $request)
    {
        set_time_limit(300);
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        // Mengimpor data dari file Excel
        Excel::import(new MasterItemImport, $request->file('file'));

        // Setelah berhasil diimpor, kembali ke halaman upload dengan pesan sukses
        return back()->with('success', 'Master items berhasil diupload.');
    }
}
