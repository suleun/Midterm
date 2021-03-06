<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $c=null;

        if (Company::all()->count() == 0){

            $c = new Company();
            $c->name = 'νλ';
            $c->save();
    
        }else{
            $c = Company::first();
        }

        return [

            'image'=> $this->faker->name(),
            'company_id'=> $c->id,
            'name'=> $this->faker->name(),
            'year'=> 2021,
            'price'=> 3000,
            'type'=> 'μΈλ¨',
            'style'=> 'SUV',

        ];
    }
}

