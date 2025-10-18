<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Relasi ke Entry
    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}