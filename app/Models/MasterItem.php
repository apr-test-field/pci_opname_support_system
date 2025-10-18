<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_code', 'item_name', 'primary_uom', 'lot_number'];  // Atur kolom yang bisa diisi
}
