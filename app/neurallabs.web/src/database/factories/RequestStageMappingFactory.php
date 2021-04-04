<?php

namespace Database\Factories;

use App\Models\Request;
use App\Models\RequestStageMapping;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestStageMappingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestStageMapping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stage_id' => rand(1, 5),
            'request_id' =>  function ($attributes) {
                return Request::find($attributes->request_id)->request_id;
            },
        ];
    }
}
