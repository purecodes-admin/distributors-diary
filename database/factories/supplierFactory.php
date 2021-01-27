<?php

namespace Database\Factories;

use App\Models\supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class supplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

           'name'=> $this->faker->name,
           'address'=> $this->faker->address,
           'email'=> $this->faker->email,
           'contact'=> $this->faker->phoneNumber,
           'discription'=> $this->faker->paragraph,
           'category'=> $this->faker->name,

        ];
    }
}
