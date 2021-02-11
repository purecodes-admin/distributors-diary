<?php

namespace App\Models;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    public function item(){
    $item=Item::paginate(5);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

}
