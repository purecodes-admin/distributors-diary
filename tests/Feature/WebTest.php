<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Factories\DataFactory;
use Illuminate\Support\Facades\Artisan;
use App\Models\supplier;
use App\Models\Item;
use App\Models\Inventory;
use Tests\TestCase;


class WebTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function AddCustomerTest()
    {
        $this->post('customer/add', [
            'distributor_id' => '$req->user()->id',
            'name' => 'some name',
            'address' => 'some address',
            'email' => 'some email',
            'contact' => 'some contact',
            'discription' => 'some paragraph',
            'category' => 'some category'
            
        ]);

        $this->assertDatabaseCount('data', 1);

    }
}
