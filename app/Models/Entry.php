<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'entries';  // Pastikan ini merujuk ke tabel entries
    protected $fillable = [
        'cell', 'master_item_id', 'tonality', 'qty_utuh', 'qty_pecah', 'note'
    ];

    // Relasi ke MasterItem
    public function masterItem()
    {
        return $this->belongsTo(MasterItem::class, 'master_item_id');
    }
}
