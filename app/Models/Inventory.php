<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'distributor_id', 'id');
    }

    // public function inventrable()
    // {
    //     return $this->morphTo();
    // }

    public function customer()
    {
        return $this->belongsTo(supplier::class, 'customer_id', 'id');
    }

    // public function purchaser()
    // {
    //     return $this->customer->where('category', 'purchaser');
    // }

    // public function supplier()
    // {
    //     return $this->customer->where('category', 'supplier');
    // }
}
