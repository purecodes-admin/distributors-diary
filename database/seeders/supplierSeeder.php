<?php

namespace Database\Seeders;
use Illuminate\support\Facades\DB;
use Illuminate\support\str;
use App\Models\supplier;
use Illuminate\Database\Seeder;

class supplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = supplier::factory()->count(10)->create([
    	]);
    }
}
