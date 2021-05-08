<?php

namespace Database\Factories;

use App\Models\MenuItemCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItemCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->name();
        return [
            'title' => $title,
            'slug' => str_replace([' ', '.', "'",'--'], '-', strtolower($title)),
            'created_at' => now(),
            'status' => 1,
        ];
    }
}
