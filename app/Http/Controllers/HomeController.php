<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Pastikan Log diimpor dengan benar


class HomeController extends Controller
{
    // Fungsi untuk menampilkan halaman Home dan history transaksi dengan filter
    public function index(Request $request)
    {
        $query = StockOpname::query();

        // Filter berdasarkan cell
        if ($request->has('cell') && $request->cell != '') {
            $query->where('cell', 'like', '%' . $request->cell . '%');
        }

        // Filter berdasarkan tanggal
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', '=', $request->date);
        }

        // Ambil data transaksi yang difilter
        $transactions = $query->latest()->paginate(10);

        // Ambil data item_name yang unik
        $itemNames = MasterItem::distinct()->pluck('item_name');

        // Kirim transaksi dan itemNames ke view
        return view('home', compact('transactions', 'itemNames'));
    }

    // Fungsi untuk mendapatkan tonality berdasarkan item_name
    public function getTonality(Request $request)
    {
        $itemName = $request->get('item_name'); // Ambil item_name dari request

        // Ambil tonality (lot_number) berdasarkan item_name yang dipilih
        $tonality = MasterItem::where('item_name', $itemName)->pluck('lot_number')->toArray();

        // Kembalikan tonality dalam format JSON (array string)
        return response()->json($tonality);
    }

    // Fungsi untuk mencari item_name berdasarkan pencarian
    public function searchItemName(Request $request)
    {
        $searchTerm = $request->get('q');
        // Hanya ambil item_name berdasarkan pencarian
        $items = MasterItem::where('item_name', 'like', '%' . $searchTerm . '%')
            ->distinct()
            ->pluck('item_name')
            ->toArray();  // Pastikan hasilnya adalah array string

        return response()->json($items);
    }

    public function destroy($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = StockOpname::findOrFail($id);
        
        // Hapus transaksi tersebut
        $transaction->delete();

        // Redirect kembali ke halaman history transaksi
        return redirect()->route('home')->with('success', 'Transaksi berhasil dihapus');
    }

    public function edit($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = StockOpname::findOrFail($id);

        // Ambil item_name yang unik untuk dropdown
        $itemNames = StockOpname::distinct()->pluck('item_name');

        // Kirim data transaksi dan itemNames ke view
        return response()->json([
            'transaction' => $transaction,
            'itemNames' => $itemNames
        ]);
    }

    // Fungsi untuk mengupdate data transaksi
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'cell' => 'required|string',
            'item_name' => 'required|string',
            'tonality' => 'required|string',
            'qty_utuh' => 'required|integer',
            'qty_pecah' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        // Cari transaksi berdasarkan ID
        $transaction = StockOpname::findOrFail($id);

        // Update data transaksi
        $transaction->update([
            'cell' => $request->input('cell'),
            'item_name' => $request->input('item_name'),
            'tonality' => $request->input('tonality'),
            'qty_utuh' => $request->input('qty_utuh'),
            'qty_pecah' => $request->input('qty_pecah'),
            'note' => $request->input('note', ''),
        ]);

        // Kirimkan data yang terupdate ke front-end
        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'cell' => 'required|string',
            'item_name' => 'required|string',
            'tonality' => 'required|string',
            'qty_utuh' => 'required|integer',
            'qty_pecah' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        // Simpan transaksi baru
        $transaction = StockOpname::create([
            'cell' => $request->input('cell'),
            'item_name' => $request->input('item_name'),
            'tonality' => $request->input('tonality'),
            'qty_utuh' => $request->input('qty_utuh'),
            'qty_pecah' => $request->input('qty_pecah'),
            'note' => $request->input('note', ''),
        ]);

        // Kirimkan data transaksi baru ke front-end
        return response()->json($transaction);
    }
}