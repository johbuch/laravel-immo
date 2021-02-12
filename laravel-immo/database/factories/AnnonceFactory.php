<?php

namespace Database\Factories;

use App\Models\Annonce;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnnonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Annonce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ref_annonce' => Str::random(8),
            'prix_annonce' => random_int(100000, 1000000),
            'surface_habitable' => random_int(25, 300),
            'nombre_de_piece' => random_int(1, 6),
        ];
    }
}
