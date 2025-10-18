<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    protected $table = 'stock_opname';  // Pastikan ini merujuk ke tabel stock_opname
    protected $fillable = [
        'cell', 'item_name', 'tonality', 'qty_utuh', 'qty_pecah', 'note'
    ];
}
