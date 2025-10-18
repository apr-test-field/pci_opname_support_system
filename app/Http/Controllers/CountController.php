<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Models\MasterItem;
use Illuminate\Http\Request;

class CountController extends Controller
{

    // Fungsi untuk menyimpan transaksi baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cell' => 'required|string',
            'item_name' => 'required|string',
            'tonality' => 'required|string',
            'qty_utuh' => 'required|numeric',
            'qty_pecah' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        try {
            $entry = new StockOpname();
            $entry->cell = $request->input('cell');
            $entry->item_name = $request->input('item_name');
            $entry->tonality = $request->input('tonality');
            $entry->qty_utuh = $request->input('qty_utuh');
            $entry->qty_pecah = $request->input('qty_pecah');
            $entry->note = $request->input('note');
            $entry->save();

            return redirect()->route('home')->with('success', 'Data transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data transaksi: ' . $e->getMessage());
        }
    }

}