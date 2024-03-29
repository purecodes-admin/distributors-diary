<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function expenses()
    {
        return $this->belongsToMany(Expenses::class);
    }

    public function distributor()
    {
        return $this->belongsTo(User::class);
    }
}
